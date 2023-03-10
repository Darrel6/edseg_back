<?php

namespace App\Http\Controllers;

use App\Models\Ue;
use Illuminate\Http\Request;

class UeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ues = Ue::all();
   
        return response()->json([
            "status" => "success",
            "data" => $ues
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
            

        ]);

        $document = new Ue();
        $document->name = $request->name;
        $document->coeff = $request->coeff;
        $document->formation = $request->formation;
        $document->save();



        return response()->json([
            "status" => "success",
            "message" => "Ue enrégistré avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ue  $ue
     * @return \Illuminate\Http\Response
     */
    public function show(Ue $ue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ue  $ue
     * @return \Illuminate\Http\Response
     */
    public function edit(Ue $ue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ue  $ue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ue $ue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ue  $ue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ue $ue)
    {
        //
    }
}