<?php

namespace App\Http\Controllers;

use App\Mail\DiplomeSend;
use App\Models\Diplome;
use App\Mail\OrderShipped;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DiplomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diplomes = Diplome::orderBy('created_at', 'desc')->get();
        return response()->json([
            "status" => "success",
            "data" => $diplomes
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
            'prenom' => 'required',
            'email' => 'required',
            'date_naiss' => 'required',
            'date_soutenance' => 'required',
            'category' => 'required',
            'promotion' => 'required',
            'matricule' => 'required',
            'annee_ac' => 'required',
            'lieu_naiss' => 'required',
            'annee_etude' => 'required',
            'formation' => 'required',

        ]);
        $random = date("Y") . '-' . rand(0, 9999);
        $diplome = new Diplome();
        $diplome->name = $request->name;
        $diplome->prenom = $request->prenom;
        $diplome->email = $request->email;
        $diplome->date_naiss = $request->date_naiss;
        $diplome->date_soutenance = $request->date_soutenance;
        $diplome->matricule = $request->matricule;
        $diplome->annee_ac = $request->annee_ac;
        $diplome->annee_etude = $request->annee_etude;
        $diplome->lieu_naiss = $request->lieu_naiss;
        $diplome->lieu_naiss = $request->lieu_naiss;
        $diplome->category = $request->category;
        $diplome->promotion = $request->promotion;
        $diplome->formation = $request->formation;
        $diplome->status = 'pending';
        $diplome->pdf_diplome = " ";
        $diplome->num_demande = $random;


        $diplome->save();

        Mail::to("contact@edseg.com")->send(new OrderShipped($diplome));
        Mail::to($request->email)->send(new OrderShipped($diplome));


        return response()->json([
            "status" => "success",
            "message" => "Demande envoyée avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diplome  $diplome
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {


     
        $diplome = Diplome::where('matricule', $url)->get()->first();

        return response()->json([
            "status" => "success",
            "data" => $diplome

        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diplome  $diplome
     * @return \Illuminate\Http\Response
     */
    public function edit(Diplome $diplome)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diplome  $diplome
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->pdf_diplome) {
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
        $diplome = Diplome::where("matricule", $request->matricule)
            ->where("formation", $request->formation)
            ->get()->first();



        Mail::to($diplome->email)->send(new DiplomeSend($diplome));
        return response()->json([
            "status" => "success",
            "message" => "Document envoyé aec succès",
        ]);
    }
    public function dpdf($id)
    {
        $diplome = Diplome::where("id", $id)

            ->get()->first();
        $url = public_path() . '/' . $diplome->pdf_diplome;
        $name = substr($url, strrpos($url, '/') + 1);
        $file = base64_encode(file_get_contents($url));
        $headers = array(
            'Content-Type: application/pdf',
        );


        if ($diplome) {
            return response()->json([
                "status" => "success",
                "message" => 'Téléchargement réussi',
                "file" =>  $file,
                "name" => $name
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => 'no element'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diplome  $diplome
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diplome $diplome)
    {
        //
    }
}