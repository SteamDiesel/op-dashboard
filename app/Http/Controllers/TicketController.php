<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\Activity;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tickets = Ticket::whereUserId(Auth::user()->id)->where('is_open', 1)->with(['user:id,name,profile_photo_path'])->orderBy('updated_at', 'desc')->get();

        return Inertia::render('Tickets/Index', [
            'tickets' => $tickets
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function closed_index()
    {
        //

        $tickets = Ticket::whereUserId(Auth::user()->id)->where('is_open', 0)->with(['user:id,name,profile_photo_path'])->orderBy('updated_at', 'desc')->get();

        return Inertia::render('Tickets/Index', [
            'tickets' => $tickets
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team_index()
    {
        //

        $tickets = Ticket::whereTeamId(Auth::user()->currentTeam->id)->where('is_open', 1)->with(['user:id,name,profile_photo_path'])->orderBy('updated_at', 'desc')->get();

        return Inertia::render('Tickets/Index', [
            'tickets' => $tickets
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function team_closed_index()
    {
        //
        $tickets = Ticket::whereTeamId(Auth::user()->currentTeam->id)->where('is_open', 0)->with(['user:id,name,profile_photo_path'])->orderBy('updated_at', 'desc')->get();

        return Inertia::render('Tickets/Index', [
            'tickets' => $tickets
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
        $user = Auth::user();
        $ticket = new Ticket();
        $ticket->user()->associate($user);
        $ticket->team()->associate($user->currentTeam);
        $ticket->save();
        $a = new Activity;
        $a->user()->associate($user);
        $a->team()->associate($user->currentTeam);
        $a->ticket()->associate($ticket);
        $a->type = "create";
        $a->endpoint = "NA";
        $a->parameters = "NA";
        $a->result = "Success";
        $a->details = "New Ticket Created.";
        $a->save();
        return redirect('/ticket/' . $ticket->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
        $ticket->pms = json_decode($ticket->pms);
        $ticket->users = json_decode($ticket->users);
        $ticket->properties = json_decode($ticket->properties);
        $ticket->agencies = json_decode($ticket->agencies);
        $ticket->tenants = json_decode($ticket->tenants);
        $ticket->owners = json_decode($ticket->owners);
        $ticket->tradies = json_decode($ticket->tradies);
        $ticket->snapshot = json_decode($ticket->snapshot);
        $ticket->tasks = json_decode($ticket->tasks);
        $ticket->user;
        $team = Auth::User()->currentTeam->makeHidden(['client_secret', 'client_id', 'access_token', 'token_type', 'refresh_token']);
        $team->allUsers();
        return Inertia::render('Tickets/Pages/Users', [
            'ticket' => $ticket,
            'team' => $team
        ]);
    }

    /**
     * Show the page for activity of the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function page(Ticket $ticket, $page)
    {
        $ticket->pms = json_decode($ticket->pms);
        $ticket->users = json_decode($ticket->users);
        $ticket->properties = json_decode($ticket->properties);
        $ticket->agencies = json_decode($ticket->agencies);
        $ticket->tenants = json_decode($ticket->tenants);
        $ticket->owners = json_decode($ticket->owners);
        $ticket->tradies = json_decode($ticket->tradies);
        $ticket->snapshot = json_decode($ticket->snapshot);
        $ticket->tasks = json_decode($ticket->tasks);
        $ticket->user;
        $team = Auth::User()->currentTeam->makeHidden(['client_secret', 'client_id', 'access_token', 'token_type', 'refresh_token']);
        $team->allUsers();

        if ($page == 'dive') {
            return Inertia::render('Tickets/Pages/Dive', [
                'ticket' => $ticket,
                'team' => $team
            ]);
        }
        if ($page == 'activity') {
            $activity = Activity::where('ticket_id', $ticket->id)->get();
            return Inertia::render('Tickets/Pages/Activity', [
                "activity" => $activity,
                'ticket' => $ticket,
                'team' => $team
            ]);
        }
        if ($page == 'data') {
            return Inertia::render('Tickets/Pages/Data', [
                'ticket' => $ticket,
                'team' => $team
            ]);
        }
        if ($page == 'users') {
            return Inertia::render('Tickets/Pages/Users', [
                'ticket' => $ticket,
                'team' => $team
            ]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        // the Show page is also the edit page, no need for edit.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $data = (object) $request->ticket;

        $ticket->user_id = $data->user_id;
        $ticket->team_id = $data->team_id;
        $ticket->is_open = $data->is_open;
        $ticket->linked_ticket_id = $data->linked_ticket_id;
        $ticket->title = $data->title;
        $ticket->description = $data->description;
        $ticket->pms = $data->pms;
        $ticket->users = $data->users;
        $ticket->properties = $data->properties;
        $ticket->agencies = $data->agencies;
        $ticket->tenants = $data->tenants;
        $ticket->owners = $data->owners;
        $ticket->tradies = $data->tradies;
        $ticket->snapshot = $data->snapshot;
        $ticket->tasks = $data->tasks;

        if ($ticket->save()) {
            return response()->json([
                'message' => 'Ticket Updated',
            ]);
        } else {
            return response()->json([
                'message' => 'Failed to Update Ticket.',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
