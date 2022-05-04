<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TicketApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mergetradies(Request $request)
    {
        //
        // return $request;
        $parent = $request->parent;
        $children = implode(",", $request->children);
        return $request;

        $endpoint = env('API_URL') . '/api/mergeTradies';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->post($endpoint, [
                "parent" => "email@gmail.com", // valid tradie account
                "children" => ["email1@email.com", "email2@email.com"] // array of emails
            ]);
        return $response;

        if ($response->successful()) {
            if (is_array($response->object()->data)) {
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Array",
                    'response' => $response->object()->data
                ]);
            }
            if (is_object($response->object()->data)) {
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Object",
                    'response' => $response->object()->data
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => "The request was successful. Other, maybe XML?",
                'response' => $response->object()->data
            ]);
        } else {
            return response()->json([
                "success" => false,
                'message' => "The request failed at the API Endpoint.",
                'response' => $response->object()->data
            ]);
        }
        // return response()->json(["user" => "user"]);
    }
}
