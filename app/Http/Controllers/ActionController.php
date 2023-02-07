<?php

namespace App\Http\Controllers;

use App\Models\Diplome;
use App\Mail\DiplomeSend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{
    public function notifi(Diplome $diplome)
    {
        $diplome = Diplome::orderBy('created_at', 'desc')->take(5)->get();
        return response()->json([
            "status" => "success",
            "data" => $diplome
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diplome  $diplome
     * @return \Illuminate\Http\Response
     */
    public function updateRq(Request $request, Diplome $diplome)
    {
         $request->validate([
            'name' => 'required',
            'matricule' => 'required',
            'formation' => 'required',
            "status"=>'required',
        ]); 

        if ($request->pdf_diplome != null) {
            $pieceName = time() . '.' . $request->pdf_diplome->getClientOriginalExtension();

            $piecepath = $request->file('pdf_diplome')->storeAs(
                'public/diplomes',
                $pieceName

            );
        };

        Diplome::where("matricule", $request->matricule)
            ->where("formation", $request->formation)
            ->update([
                "status" => $request->status,
                "pdf_diplome" => Storage::url($piecepath)
            ]);
        
        
        Mail::to($request->email)->send(new DiplomeSend($request));

        return response()->json([
            "status" => "success",
            "message" => "Document envoyé aec succès",
           
        ]);
    }
}