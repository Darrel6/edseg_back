<?php

namespace App\Http\Controllers;

use App\Models\Ecue;
use Illuminate\Http\Request;

class EcueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ecues = Ecue::all();
   
        return response()->json([
            "status" => "success",
            "data" => $ecues
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'coeff' => 'required',
            'ue_id' => 'required'

        ]);

        $document = new Ecue();
        $document->name = $request->name;
        $document->coeff = $request->coeff;
        $document->ue_id = $request->ue_id;
        $document->save();



        return response()->json([
            "status" => "success",
            "message" => "Ue enrégistré avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ecue  $ecue
     * @return \Illuminate\Http\Response
     */
    public function show(Ecue $ecue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ecue  $ecue
     * @return \Illuminate\Http\Response
     */
    public function edit(Ecue $ecue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ecue  $ecue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ecue $ecue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ecue  $ecue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ecue $ecue)
    {
        //
    }
}