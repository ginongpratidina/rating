<?php

namespace App\Http\Controllers\API;

use App\Models\ListGuest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Http\Resources\ListGuestResource;

class ListGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ListGuest::latest()->get();
        return response()->json(['details' => ListGuestResource::collection($data)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListGuest  $listGuest
     * @return \Illuminate\Http\Response
     */
    public function show(ListGuest $listGuest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListGuest  $listGuest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ListGuest $listGuest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListGuest  $listGuest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ListGuest $listGuest)
    {
        //
    }
}
