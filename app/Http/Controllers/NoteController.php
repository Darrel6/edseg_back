<?php

namespace App\Http\Controllers;

use App\Models\Ecue;
use App\Models\Note;
use App\Models\Ue;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class NoteController extends Controller
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
            'prenom' => 'required',
            'matricule' => 'required',
            'gender' => 'required',
            'session' => 'required',
            'note_ecue' => 'required',
            'ecue_id' => 'required',
            'formation' => 'required',

        ]);

        $document = new Note();
        $document->name = $request->name;
        $document->prenom = $request->prenom;
        $document->matricule = $request->matricule;
        $document->gender = $request->gender;
        $document->session = $request->session;
        $document->note_ecue =  $request->note_ecue;
        $document->ecue_id = $request->ecue_id;
        $document->formation = $request->formation;

        $document->save();



        return response()->json([
            "status" => "success",
            "message" => "Resultat enrégistré avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show($matricule)
    {

        $ue = [];
        $moy = [];
       

        $ues = Ue::all();
        foreach ($ues as $note) {

            /* $ecues = Ecue::where("ue_id", $note->id)->get(); */
            $notes = Note::where("matricule", $matricule)->with('ecue')->get()->toArray();

            $cumul = 0;
            $i = 0;
            $total_vald = 0;
            $coef = 0;
            $ec = [];
            foreach ($notes as $not) {
                if ($not['ecue']['ue_id'] == $note->id) {


                    $coef = $coef + $not['ecue']['coeff'];
                    $cumul = ($cumul + ($not['note_ecue'] * $not['ecue']['coeff'])) / $coef;
                    $i++;

                    if ($cumul >= 10) {
                        $vald = 'V';
                        $total_vald++;
                    } else {
                        $vald = 'NV';
                    }

                    

                    $ec =  [
                        'ecue_name' => $not['ecue']['name'],
                        "coeff" => $not['ecue']['coeff'],
                        "note_obtenu" => $not['note_ecue'],
                        'note_coeff' => $not['note_ecue'] * $not['ecue']['coeff'],
                    ];


                    $moy =  [
                        "totals_validée" => $total_vald,
                        "validation" => $vald,
                        "moyenne"  => $cumul,
                        'ecues' => [$ec],
                        'ue_id' => $not['ecue']['ue_id']


                    ];


                    $ue = Arr::add($ue, "ue" . $not['ecue']['ue_id'], $moy);
                }
            }
        }



        /*  $note_coeff = [];
        $val = [];
        foreach ($notes as $not) {

            if ($not['ue_id'] == $not['ue_id']) {
                $nt_coeff = (($not['note_ecue'] += $not['note_ecue']) * ($not['coeff'] += $not['coeff']) / ($not['coeff'] += $not['coeff']));
                $note_coeff = Arr::add($note_coeff, 'moyenne' . $not['ue_id'], $nt_coeff);
                
            }

            foreach ($note_coeff as $v) {
                $tv = 0;
                $valid = '';
                if ($v >= 10) {
                  
                    $valid = "V";
                    $tv++;
                } else {
                    $valid = "NV";
                };

                Arr::add($val, 'validation' . $not['ue_id'], $valid);
            }
        }
        $validate = [];
     
      
      
        Arr::add($validate, "validations", $val); */


        return response()->json([
            "status" => "success",
            "data" => $ue,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
