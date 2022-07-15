<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class OurPropertyUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $endpoint = env('API_URL') . '/api/GetUserInfo';
        $search = false;

        if ($request->email) {

            $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
                ->get($endpoint, [
                    'UserName' => $request->email
                ]);
            if ($response->successful()) {
                $search = true;
            } else {
                return redirect('/auth/refresh');
            }
        }
        if ($request->mobile) {

            $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
                ->get($endpoint, [
                    'Mobile' => $request->mobile
                ]);
            if ($response->successful()) {
                $search = true;
            } else {
                return redirect('/auth/refresh');
            }
        }
        if ($request->agency_id) {
            $skip = $request->page - 1;
            $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
                ->get($endpoint, [

                    'AgencyID' => $request->agency_id,
                    'UserType' => $request->user_type,
                    'Skip' =>  $skip * 25
                ]);
            if ($response->successful()) {
                $search = true;
            } else {
                return redirect('/auth/refresh');
            }
        }
        if ($search) {
            if (is_array($response->object()->data)) {
                return Inertia::render('Users/Index', [
                    'users' => $response->object()->data
                ]);
            }
            if (is_object($response->object()->data)) {
                $users = [];
                array_push($users, $response->object()->data);
                return Inertia::render('Users/Index', [
                    'users' => $users
                ]);
            }
        }

        return Inertia::render('Users/Index', [
            'users' => []
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        //
        $token = Auth::user()->currentTeam->access_token;
        $endpoint = env('API_URL') . '/api/GetUserInfo';

        // first get the user
        $response = Http::withToken($token)->acceptJson()
            ->get($endpoint, [
                'UserID' => $user
            ]);


        if ($response->successful()) {
            return Inertia::render('Users/Show', [
                'u' => $response->object()->data,
            ]);
        } else {
            return redirect('/auth/refresh');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fetch(Request $request)
    {
        //
        $token = Auth::user()->currentTeam->access_token;
        $endpoint = env('API_URL') . '/api/GetUserInfo';

        // first get the user
        if ($request->email) {

            $response = Http::withToken($token)->acceptJson()
                ->get($endpoint, [
                    'Email' => $request->email
                ]);
        }
        if ($request->phone) {

            $response = Http::withToken($token)->acceptJson()
                ->get($endpoint, [
                    'Mobile' => $request->phone,
                ]);
        }
        if ($request->user_id) {

            $response = Http::withToken($token)->acceptJson()
                ->get($endpoint, [
                    'UserID' => $request->user_id
                ]);
        }
        $users = array();
        if (is_array($response->object()->data)) {
            $users = $response->object()->data;
        } else {
            array_push($users, $response->object()->data);
        }

        if ($response->successful()) {
            return response()->json([
                'users' => $users,
                'message' => "request was successful, all users are attached as an array."
            ]);
        } else {
            return response()->json([
                'message' => "The request failed. Maybe this app is not authenticated?"
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function goAutoLogin(Request $request)
    {
        //

        $proceed = false;
        $solved = $request->token / 36 + 120;

        $expiry = date('Y-m-d h:i:s', $solved);
        $server = date('Y-m-d h:i:s', floor(microtime(true)));
        $expiry_time = new DateTime($expiry);
        $server_time = new DateTime($server);

        if ($expiry_time > $server_time) {
            $proceed = true;
        }
        if ($proceed) {
            // return "valid link - expiry: " . $expiry . " - current time: " . $server;
            $portal = "PM";
            switch ($request->user_type) {
                case "t":
                    $portal = "T";
                    break;
                case "":
                    $portal = "O";
                    break;
                case "ll":
                    $portal = "LL";
                    break;
                case "tr":
                    $portal = "TR";
                    break;
                case "pm":
                    $portal = "PM";
                    break;
                case "OA":
                    $portal = "PM";
                    break;
                case "OM":
                    $portal = "PM";
                    break;
            }

            $token = User::find($request->a)->currentTeam->access_token;
            $endpoint = env('API_URL') . '/api/GetAutoLogin';

            // first get the user
            // if ($request->email) {

            //     $response = Http::withToken($token)->acceptJson()
            //         ->get($endpoint, [
            //             'Username' => $request->email,
            //             'Portal' => $portal
            //         ]);
            // }
            if ($request->user_id) {

                $response = Http::withToken($token)->acceptJson()
                    ->get($endpoint, [
                        'UserID' => $request->user_id,
                        'Portal' => $portal
                    ]);
            }

            if ($response->successful()) {
                return redirect()->away($response->object()->data);
            } else {
                return response()->json([
                    'message' => "The request failed. Maybe this app is not authenticated?"
                ]);
            }
        }
        return "This link is dead.";
    }

    /**
     * Get the Properties for the Users and return in a table view.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function properties(Request $request)
    {
        $endpoint = env('API_URL') . '/api/GetPropertyInfo';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                'TenantID' => $request->user_id
            ]);
        if ($response->successful()) {
            return $response->object()->data;
            return Inertia::render('Users/Show', [
                'properties' => $response->object()->data
            ]);
        } else {
            return redirect('/auth/refresh');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function agency(Request $request)
    {
        $endpoint = env('API_URL') . '/api/GetAgencyInfo';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                'AgencyID' => $request->agency_id
            ]);

        if ($response->successful()) {
            return $response->object()->data;
            return Inertia::render('Users/Show', [
                'agency' => $response->object()->data
            ]);
        } else {
            return redirect('/auth/refresh');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tenancies(Request $request)
    {
        $endpoint = env('API_URL') . '/api/GetTenantInfo';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                'UserID' => $request->user_id
            ]);

        if ($response->successful()) {
            return $response->object()->data;
            return Inertia::render('Users/Show', [
                'tenancy' => $response->object()->data
            ]);
        } else {
            return redirect('/auth/refresh');
        }
    }
}
