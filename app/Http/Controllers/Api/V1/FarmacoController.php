<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\farmaco;
use Illuminate\Http\Request;
use App\Http\Resources\V1\FarmacoResource;


class FarmacoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FarmacoResource::collection(farmaco::latest()->paginate());

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
     * @param  \App\Models\farmaco  $farmaco
     * @return \Illuminate\Http\Response
     */
    public function show(farmaco $farmaco)
    {
        return new FarmacoResource($farmaco);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\farmaco  $farmaco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, farmaco $farmaco)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\farmaco  $farmaco
     * @return \Illuminate\Http\Response
     */
    public function destroy(farmaco $farmaco)
    {
        if ($farmaco->delete()) {
            return response()->json([
                'message'=>'Success'
            ], 204);
        } 
        return response()->json([
            'message'=>'Not found'
        ], 404);
    }
    
}
