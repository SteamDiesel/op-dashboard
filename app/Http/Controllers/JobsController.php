<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $endpoint = env('API_URL') . '/api/JobRetrieve';

        if ($request->property_id) {

            $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
                ->get($endpoint, [
                    'PropertyID' => $request->property_id
                ]);
            if ($response->successful()) {
                if (is_array($response->object()->data)) {
                    return Inertia::render('Jobs/Index', [
                        'jobs' => $response->object()->data
                    ]);
                }
                if (is_object($response->object()->data)) {
                    $ar = [];
                    array_push($ar, $response->object()->data);
                    return Inertia::render('Jobs/Index', [
                        'jobs' => $ar
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
                ]);

            if ($response->successful()) {
                if (is_array($response->object()->data)) {
                    return Inertia::render('Jobs/Index', [
                        'jobs' => $response->object()->data
                    ]);
                }
                if (is_object($response->object()->data)) {
                    $ar = [];
                    array_push($ar, $response->object()->data);
                    return Inertia::render('Jobs/Index', [
                        'jobs' => $ar
                    ]);
                }
            } else {
                return redirect('/auth/refresh');
            }
        }

        return Inertia::render('Jobs/Index', [
            'jobs' => []
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
        return 'Create';
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
        return 'Store';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($job)
    {
        //
        $endpoint = env('API_URL') . '/api/JobRetrieve';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                'ID' => $job
            ]);

        if ($response->successful()) {
            return Inertia::render('Jobs/Show', [
                'query' => $job,
                'job' => $response->object()->data
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
        return 'edit';
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
        return 'Update';
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
        return "delete";
    }
}
