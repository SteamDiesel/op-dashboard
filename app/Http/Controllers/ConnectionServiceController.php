<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Nette\Utils\Random;

class ConnectionServiceController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function connect()
    {
        $state = rand(1000, 9999);
        $redirect = env('APP_URL') . '/authenticated';
        $team = Auth::user()->currentTeam;
        $endpoint = env('API_URL') . '/api/authorize?response_type=code&client_id=' . $team->client_id .
            '&authorize=1&redirect_uri=' . $redirect .
            '&state=' . $state;



        return Inertia::render('ConnectApi', [
            'url' => $endpoint,
            'team' => $team
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_token(Request $request)
    {
        $redirect = env('APP_URL') . '/authenticated';
        $endpoint = env('API_URL') . '/api/token';

        $team = Auth::user()->currentTeam;

        $response = Http::post($endpoint, [
            'code' => $request->code,
            'client_id' => $team->client_id,
            'client_secret' => $team->client_secret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirect
        ]);
        if ($response->failed()) {
            return response()->json([
                "message" => "uh oh, the API endpoint failed to accept the connection.",
                "response" => $response
            ]);
        }

        $team->access_token = $response['access_token'];
        $team->expires_in = $response['expires_in'];
        $team->token_type = $response['token_type'];
        $team->scope = $response['scope'];
        $team->refresh_token = $response['refresh_token'];

        $team->save();

        return redirect('/tickets');
    }

    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh_token()
    {
        $team = Auth::user()->currentTeam;
        $redirect = env('APP_URL') . '/authenticated';
        $endpoint = env('API_URL') . '/api/token';

        $response = Http::post($endpoint, [
            'refresh_token' => $team->refresh_token,
            'client_id' => $team->client_id,
            'client_secret' => $team->client_secret,
            'grant_type' => 'refresh_token',
            'redirect_uri' => $redirect
        ]);

        $team->access_token = $response['access_token'];
        $team->expires_in = $response['expires_in'];
        $team->token_type = $response['token_type'];
        $team->scope = $response['scope'];
        $team->refresh_token = $response['refresh_token'];

        $team->save();

        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test_connection()
    {

        $token = Auth::user()->currentTeam->access_token;
        $endpoint = env('API_URL') . '/api/GetUserInfo';
        $response = Http::withToken($token)->acceptJson()
            ->get($endpoint, [
                'UserID' => '77376'
            ]);
        if ($response->successful()) {
            if ($response->object()->data->UserID == '77376') {
                return $response->object();
            } else {
                return redirect('/auth/refresh');
            }
        } else {
            return "Connection error. Are the team Auth credentials entered and valid?";
        }
    }
}
