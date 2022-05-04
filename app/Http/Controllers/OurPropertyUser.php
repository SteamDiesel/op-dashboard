<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        if ($request->email) {

            $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
                ->get($endpoint, [
                    'Email' => $request->email
                ]);
            if ($response->successful()) {
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
            } else {
                return redirect('/auth/refresh');
            }
        }
        if ($request->agency_id) {

            $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
                ->get($endpoint, [

                    'AgencyID' => $request->agency_id,
                    'UserType' => $request->user_type
                ]);

            if ($response->successful()) {
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
            } else {
                return redirect('/auth/refresh');
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
     * Remove the specified resource from storage.
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
