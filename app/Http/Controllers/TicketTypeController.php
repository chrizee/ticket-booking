<?php

namespace App\Http\Controllers;

use App\TicketType;
use Illuminate\Http\Request;
use App\Http\Resources\TicketType as TicketTypeResource;
use Illuminate\Support\Facades\Validator; 

class TicketTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = TicketType::latest()->get();
        return TicketTypeResource::collection($types);
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
            'name' => "required|string|unique:ticket_types"
        ]);
        
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors(), "success" => false], 401);
        }
        
        $tickettype = TicketType::create($request->only(['name']));
        return response()->json(['success' => true, 'tickettype' => (new TicketTypeResource($tickettype))]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TicketType  $tickettype
     * @return \Illuminate\Http\Response
     */
    public function show(TicketType $tickettype)
    {
        return response()->json(['success' => true, 'tickettype' => (new TicketTypeResource($tickettype))]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketType  $tickettype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketType $tickettype)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required|string|unique:ticket_types"
        ]);
        
        if($validator->fails()) {
            return response()->json(['error' => $validator->errors(), "success" => false], 401);
        }
        
        $tickettype->name = $request->input("name");
        if($tickettype->save()) {
            return response()->json(['success' => true, 'type' => (new TicketTypeResource($tickettype))]);
        }else {
            return response()->json(['success' => true, 'message' => "something went wrong while updating ticket type"]);
        }
    }
}
