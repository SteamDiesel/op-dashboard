<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class TicketApiController extends Controller
{
    /**
     * Merge Users together. accepts one parent and multiple children.
     *
     * @return \Illuminate\Http\Response
     */
    public function mergeUsers(Request $request)
    {
        //
        // return $request;
        $parent = $request->parent;
        $children = implode(",", $request->children);
        return $request;

        $endpoint = env('API_URL') . '/api/mergeUsers';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->post($endpoint, [
                "parent" => "854775", // valid user account ID
                "children" => ["885669", "887995"] // array of IDs
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPropertyTenancies(Request $request)
    {
        //
        $endpoint = env('API_URL') . '/api/GetTenantInfo';
        foreach ($ids as $id) {
            $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
                ->get($endpoint, [
                    "UserID" => $id
                ]);
            if ($response->successful()) {
                array_push($tenants, $response->object()->data);
            }
        }
        return $tenants;

        $endpoint = env('API_URL') . '/api/GetTenantInfo';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                "UserID" => $request->id
            ]);
        // return $response;

        if ($response->successful()) {
            if (is_array($response->object()->data)) {
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Array",
                    'tcy' => $response->object()->data
                ]);
            }
            if (is_object($response->object()->data)) {
                $ar = [];
                array_push($ar, $response->object()->data);
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Object",
                    'tcy' => $ar
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => "The request was successful. Other, maybe XML?",
                'tcy' => $response->object()->data
            ]);
        } else {
            return response()->json([
                "success" => false,
                'message' => "The request failed at the API Endpoint.",
                'tcy' => $response->object()->data
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserTenancies(Request $request)
    {
        //
        // return $request;

        $endpoint = env('API_URL') . '/api/GetTenantInfo';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                "UserID" => $request->id
            ]);
        // return $response;

        if ($response->successful()) {
            if (is_array($response->object()->data)) {
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Array",
                    'tcy' => $response->object()->data
                ]);
            }
            if (is_object($response->object()->data)) {
                $ar = [];
                array_push($ar, $response->object()->data);
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Object",
                    'tcy' => $ar
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => "The request was successful. Other, maybe XML?",
                'tcy' => $response->object()->data
            ]);
        } else {
            return response()->json([
                "success" => false,
                'message' => "The request failed at the API Endpoint.",
                'tcy' => $response->object()->data
            ]);
        }
    }


    /**
     * get and return the properties of a given user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProperties(Request $request)
    {
        $endpoint = env('API_URL') . '/api/GetPropertyInfo';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                'TenantID' => $request->user_id
            ]);
        if ($response->successful()) {
            if (is_array($response->object()->data)) {
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Array",
                    'pty' => $response->object()->data
                ]);
            }
            if (is_object($response->object()->data)) {
                $ar = [];
                array_push($ar, $response->object()->data);
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Object",
                    'pty' => $ar
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => "The request was successful. Other, maybe XML?",
                'pty' => $response->object()->data
            ]);
        } else {
            return response()->json([
                "success" => false,
                'message' => "The request failed at the API Endpoint.",
                'pty' => $response->object()->data
            ]);
        }
    }


    /**
     * get and return the properties of a given user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPropertyJobs(Request $request)
    {
        $endpoint = env('API_URL') . '/api/JobRetrieve';
        $response = Http::withToken(Auth::user()->currentTeam->access_token)->acceptJson()
            ->get($endpoint, [
                'PropertyID' => $request->property_id
            ]);
        if ($response->successful()) {
            if (is_array($response->object()->data)) {
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Array",
                    'jobs' => $response->object()->data
                ]);
            }
            if (is_object($response->object()->data)) {
                $ar = [];
                array_push($ar, $response->object()->data);
                return response()->json([
                    'success' => true,
                    'message' => "The request was successful. Object",
                    'jobs' => $ar
                ]);
            }
            return response()->json([
                'success' => true,
                'message' => "The request was successful. Other, maybe XML?",
                'jobs' => $response->object()->data
            ]);
        } else {
            return response()->json([
                "success" => false,
                'message' => "The request failed at the API Endpoint.",
                'jobs' => []
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        //
        $user = Auth::user();
        $token = $user->currentTeam->access_token;
        $endpoint = env('API_URL') . '/api/GetUserInfo';
        $a = new Activity;
        $a->user()->associate($user);
        $a->team()->associate($user->currentTeam);
        $a->ticket()->associate($request->ticket_id);

        $a->type = "api_read";
        $a->endpoint = $endpoint;

        // first get the user
        if ($request->email) {
            $a->parameters = $request->email;
            $a->details = "searched for user by Email";
            $response = Http::withToken($token)->acceptJson()
                ->get($endpoint, [
                    'Email' => $request->email
                ]);
        }
        if ($request->phone) {
            $a->details = "searched for user by Mobile";
            $a->parameters = $request->phone;
            $response = Http::withToken($token)->acceptJson()
                ->get($endpoint, [
                    'Mobile' => $request->phone,
                ]);
        }
        if ($request->user_id) {
            $a->details = "searched for user by UserID";
            $a->parameters = $request->user_id;
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
            $a->result = "Success";
            $a->save();
            return response()->json([
                'users' => $users,
                'message' => "request was successful, all users are attached as an array."
            ]);
        } else {
            $a->result = "Failed";
            $a->save();
            return response()->json([
                'message' => "The request failed. Maybe this app is not authenticated?"
            ]);
        }
    }
}
