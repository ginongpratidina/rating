<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Ticket;
use App\Http\Resources\TicketResource;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Ticket::latest()->get();
        return response()->json([TicketResource::collection($data), 'Ticket fetched.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type' => 'required|string|max:2',
            'user_id' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $ticket = Ticket::create([
            'type' => $request->type,
            'desc' => $request->desc,
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'user_id' => $request->user_id,
         ]);
        
        return response()->json(['Ticket created successfully.', new TicketResource($ticket)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        if (is_null($ticket)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new TicketResource($ticket)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $validator = Validator::make($request->all(),[
            'type' => 'required|string|max:2',
            'user_id' => 'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $ticket->type = $request->type;
        $ticket->desc = $request->desc;
        $ticket->name = $request->name;
        $ticket->no_hp = $request->no_hp;
        $ticket->user_id = $request->user_id;
        $ticket->save();
        
        return response()->json(['Ticket updated successfully.', new TicketResource($ticket)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json('Ticket deleted successfully');
    }
}
