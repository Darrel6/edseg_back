<?php

namespace App\Http\Controllers;

use App\Models\Calendrier;
use Illuminate\Http\Request;

class CalendrierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $calendriers = Calendrier::where("annee",  date("Y"))
            ->where("semester", "Semestre 1")->orderBy("date")->get();



        return response()->json([
            "status" => "success",
            "data" => $calendriers
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
            'annee' => 'required',
            'semester' => 'required',
            'date' => 'required',
            'matiere' => 'required',
            'heure_depart' => 'required',
            'heure_fin' => 'required',
            'enseignant' => 'required',
            'mention' => 'required',
        ]);

        $calendrier = new Calendrier();
        $calendrier->annee = $request->annee;
        $calendrier->semester = $request->semester;
        $calendrier->date = $request->date;
        $calendrier->matiere = $request->matiere;
        $calendrier->enseignant = $request->enseignant;
        $calendrier->mention = $request->mention;
        $calendrier->heure_depart = $request->heure_depart;
        $calendrier->heure_fin = $request->heure_fin;

        $calendrier->save();

        return response()->json([
            "status" => "success",
            "message" => "Ajouté avec succès",
            
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calendrier  $calendrier
     * @return \Illuminate\Http\Response
     */
    public function show(Calendrier $calendrier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calendrier  $calendrier
     * @return \Illuminate\Http\Response
     */
    public function edit(Calendrier $calendrier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calendrier  $calendrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calendrier $calendrier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calendrier  $calendrier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calendrier $calendrier)
    {
        //
    }
}