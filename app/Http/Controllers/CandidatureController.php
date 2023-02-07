<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidatureRequest;
use App\Models\Candidature;
use Illuminate\Http\Request;

class CandidatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidatures = Candidature::all();
        return response()->json([
            "status" => "success",
            "data" => $candidatures
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
    public function store(CandidatureRequest $request)
    {
        $candidature = new Candidature();
        $candidature->firstname = $request->firstname;
        $candidature->lastname = $request->lastname;
        $candidature->email = $request->email;
        $candidature->phone = $request->phone;
        $candidature->sexe = $request->sexe;
        $candidature->ecole = $request->ecole;

        $candidature->save();

        return response()->json([
            "status" => "success",
            "message" => "Candidature enrégistrée avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function show(Candidature $candidature)
    {
        
        $candidatures = Candidature::where('id', $candidature)->get();
  
        if ($candidatures) {
            $candidatures = Candidature::find($candidature);
            return response()->json([
                "status" => "success",
                "data" => $candidatures
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => 'no element'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidature $candidature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidature $candidature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidature  $candidature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidature $candidature)
    {
        //
    }
}