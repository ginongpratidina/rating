<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Rating;
use App\Http\Resources\RatingResource;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Rating::latest()->get();
        return response()->json([RatingResource::collection($data), 'Rating fetched.']);
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
            'star' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $rating = Rating::create([
            'ticket_id' => $request->ticket_id,
            'star' => $request->star,
            'comment' => $request->comment,
         ]);
        
        // return response()->json(['message'=>'Rating created successfully.', 'details' => new RatingResource($rating)]);
        return response()->json(['message'=>'Rating created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rating = Rating::find($id);
        if (is_null($rating)) {
            return response()->json('Data not found', 404); 
        }
        return response()->json([new RatingResource($rating)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response    
     */
    public function update(Request $request, Rating $rating)
    {
        $validator = Validator::make($request->all(),[
            // 'user_id' => 'required|string|max:255',
            // 'email_cust' => 'required|email|max:255',
            'ticket_id' => 'required|string|max:10',
            'star' => 'required',
            'comment' => 'required',
            // 'coin_tip' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $rating->ticket_id = $request->ticket_id;
        $rating->user_id = $request->user_id;
        $rating->email_cust = $request->email_cust;
        $rating->start = $request->star;
        $rating->coin_tip = $request->coin_tip;
        $rating->comment = $request->comment;
        $rating->save();
        
        return response()->json(['Rating updated successfully.', new RatingResource($rating)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();

        return response()->json('Rating deleted successfully');
    }
}
