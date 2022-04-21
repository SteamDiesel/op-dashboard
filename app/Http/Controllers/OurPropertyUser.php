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
        if ($request->email) {

            $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
                ->get('https://propertymanager.our.property/api/GetUserInfo', [
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
                ->get('https://propertymanager.our.property/api/GetUserInfo', [

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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


        // first get the user
        $response = Http::withToken($token)->acceptJson()
            ->get('https://propertymanager.our.property/api/GetUserInfo', [
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function properties(Request $request)
    {
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get('https://propertymanager.our.property/api/GetPropertyInfo', [
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
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get('https://propertymanager.our.property/api/GetAgencyInfo', [
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
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get('https://propertymanager.our.property/api/GetTenantInfo', [
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
