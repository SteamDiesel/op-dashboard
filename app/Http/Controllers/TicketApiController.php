<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getuser()
    {
        //
        return response()->json(["user" => "user"]);
    }
}
