<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Ticket;
use App\Http\Resources\TicketResource;
use App\Events\TicketCreated;

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
            'name' => 'required|string|max:25',
            'nohp' => 'required|string|max:12',
            'job' => 'required|string|max:25',
            'institution' => 'required|string|max:150',
            'necessity' => 'required',
            'bersedia' => 'required|max:1',
            'status' => 'required|max:1',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        /* 
        *   Function to generate random alphanumeric 5 digit
        */
        $char_basket = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $uniq_id = substr(str_shuffle($char_basket),0,5);
        $month = date("m");
        $year2D = substr(date("Y"),2);

        $ticket = Ticket::create([
            'noticket' => $uniq_id.'.'.$month.$year2D, // get last two digit of current year
            'name' => $request->name,
            'nohp' => $request->nohp,
            'job' => $request->job,
            'institution' => $request->institution,
            'necessity' => $request->necessity,
            'bersedia' => $request->bersedia,
            'status' => $request->status,
         ]);

        // Trigger event ti dispatch into listener (listener will call in vue through ListGuestController::class, 'index')
        // TicketCreated::dispatch();
        broadcast(new TicketCreated($ticket));

        return response()->json(['message' => 'Ticket created successfully.', 'detail' => new TicketResource($ticket)]);
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
            // 'noticket' => 'required|string|max:10',
            'status' => 'required|max:1',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);       
        }

        // update ticket status
        $ticket->update([
            'status' => $request->status
        ]);
        
        return response()->json(['Ticket status updated successfully.', new TicketResource($ticket)]);
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
