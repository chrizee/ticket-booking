<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\Ticket as TicketResource;
use Illuminate\Support\Facades\Validator; 


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::latest()->get();
        return TicketResource::collection($tickets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'event' => "required|string",
            'ticket_type_id' => "required|exists:ticket_types,id",
            'price' => "required|numeric",
            'total_number_available' => "required|integer|min:0",
            'number_sold' => "integer|min:0",
            'number_unsold' => "integer|min:0"
        ]);
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors(), "success" => false], 401);
        }
        
        $ticket = Ticket::create($request->only(['event', 'price', 'ticket_type_id', 'total_number_available', 'number_sold', 'number_unsold']));
        if($ticket) {
            return response()->json(['success' => true, 'ticket' => (new TicketResource($ticket))]);
        }else {
            return response()->json(['success' => false, 'message' => "something went wrong while creating ticket"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return response()->json(['success' => true, 'ticket' => (new TicketResource($ticket))]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(), [
            'event' => "string",
            'ticket_type_id' => "exists:ticket_types,id",
            'price' => "numeric",
            'total_number_available' => "integer|min:0",
            'number_sold' => "integer|min:0",
            'number_unsold' => "integer|min:0"
        ]);
        
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors(), "success" => false], 401);
        }
        $ticket->event = $request->input("event") ? $request->input("event") : $ticket->event;
        $ticket->ticket_type_id = $request->input("ticket_type_id") ? $request->input("ticket_type_id") : $ticket->ticket_type_id;
        $ticket->price = $request->input("price") ? $request->input("price") : $ticket->price;
        $ticket->total_number_available = $request->input("total_number_available") ? $request->input("total_number_available") : $ticket->total_number_available;
        $ticket->number_sold = $request->input("number_sold") ? $request->input("number_sold") : $ticket->number_sold;
        $ticket->number_unsold = $request->input("number_unsold") ? $request->input("number_unsold") : $ticket->number_unsold;
        
        if($ticket->save()) {
            return response()->json(['success' => true, 'ticket' => (new TicketResource($ticket))]);
        }else {
            return response()->json(['success' => false, 'message' => "something went wrong while updating ticket"]);
        }
    }

}
