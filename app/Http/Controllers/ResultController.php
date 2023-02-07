<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tab = [];
        $results = Result::all();
        /*    foreach($results as $result) {
            $rst =array(
                "annee" => $result->annee,
                "semester" => $result->semester,
                "formation" => $result->formation,
                "file"  => Excel::toArray(new Result, $result->file),
              
            );
            $t =json_encode($rst);
            array_push($tab,$t);
        }; */
        return response()->json([
            "status" => "success",
            "data" => $results
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
            'formation' => 'required',
            'file' => 'required',

        ]);

        $document = new Result();
        $document->annee = $request->annee;
        $document->semester = $request->semester;
        $document->formation = $request->formation;


        if ($request->file) {
            $file = $request->file('file');
            $pdfName = time() . '.' . $file->getClientOriginalExtension();
            $request->file->move('storage/resultats/', $pdfName);
            $document->file = 'storage/resultats/' . $pdfName;
        };
        $document->save();



        return response()->json([
            "status" => "success",
            "message" => "Document enrégistré avec succès"
        ]);
    }
    public function dpdf($id)
    {
        $diplome = Result::where("id", $id)

            ->get()->first();
        $url = public_path() . '/' . $diplome->file;
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
     * Display the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}