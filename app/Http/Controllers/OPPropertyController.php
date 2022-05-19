<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class OPPropertyController extends Controller
{
    //
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

        return Inertia::render('Properties/Index', [
            'users' => []
        ]);
    }
}
