<?php

namespace App\Http\Controllers\API;

use App\Models\ProgressLog;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Resources\ProgressLogResource;
use Illuminate\Http\Request;

class ProgressLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'ticket_id' => 'required|string|max:10',
            'user_id' => 'required|numeric|',
            'note' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $log = ProgressLog::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => $request->user_id,
            'note' => $request->note,
         ]);
        
        // return response()->json(['message'=>'Rating created successfully.', 'details' => new RatingResource($rating)]);
        return response()->json(['message'=>'Progress log created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgressLog  $progressLog
     * @return \Illuminate\Http\Response
     */
    public function show(ProgressLog $progressLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProgressLog  $progressLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProgressLog $progressLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProgressLog  $progressLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgressLog $progressLog)
    {
        //
    }
}
