<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

use function PHPUnit\Framework\objectEquals;

class PropertyController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Properties/Index');
    }
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($property_id)
    {


        $endpoint = env('API_URL') . '/api/GetPropertyInfo';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                'ID' => $property_id
            ]);
        if ($response->successful()) {
            return Inertia::render('Properties/Show', [
                'property' => $response->object()->data
            ]);
        } else {
            return redirect('/auth/refresh');
        }
    }
    //
    /**
     * Searches for matching properties by the given keyword.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $search = false;
        $endpoint = env('API_URL') . '/api/searchProperty';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                'Keyword' => $request->address
            ]);

        if ($response->successful()) {
            $search = true;
        } else {
            return redirect('/auth/refresh');
        }

        if ($search) {
            if (is_array($response->object()->data)) {
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Array",
                    'properties' => $response->object()->data
                ]);
            }
            if (is_object($response->object()->data)) {
                $ar = [];
                array_push($ar, $response->object()->data);
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Object",
                    'properties' => $ar
                ]);
            }
        }
    }
}
