<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ConnectionServiceController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_token(Request $request)
    {
        $redirect = env('APP_URL') . '/authenticated';

        $team = Auth::user()->currentTeam;
        $response = Http::post('https://propertymanager.our.property/api/token', [
            'code' => $request->code,
            'client_id' => $team->client_id,
            'client_secret' => $team->client_secret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirect
        ]);

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

        $response = Http::post('https://propertymanager.our.property/api/token', [
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
        $response = Http::withToken($token)->acceptJson()
            ->get('https://propertymanager.our.property/api/GetUserInfo', [
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
