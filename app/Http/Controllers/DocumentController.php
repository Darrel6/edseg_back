<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::all();
        return response()->json([
            "status" => "success",
            "data" => $documents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(Document $document)
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
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'date' => 'required',
            'category' => 'required',
            'pdf' => 'required',
        ]);

        $document = new Document();
        $document->title = $request->title;
        $document->author = $request->author;
        $document->description = $request->description;
        $document->date = $request->date;
        $document->category = $request->category;

        if ($request->pdf) {
            $file = $request->file('pdf');
            $pdfName = time() . '.' . $file->getClientOriginalExtension();
            $request->pdf->move('storage/documents/pdfs/', $pdfName);
            $document->pdf = 'storage/documents/pdfs/' . $pdfName;
        };
        $document->save();



        return response()->json([
            "status" => "success",
            "message" => "Document enrégistré avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        $documents = Document::where('id', $document)->get();

        if ($documents) {
            $documents = Document::find($document);

            return response()->json([
                "status" => "success",
                "data" => $documents
            ]);
        } else {
            return response()->json([
                "status" => "error",
                "message" => 'no element'
            ]);
        }
    }

    public function dpdf($id)
    {
        $documents = Document::where('id', $id)->get()->first();
        $url =public_path() .'/'. $documents->pdf;
        $name = substr($url, strrpos($url, '/') + 1);
        $file = base64_encode(file_get_contents($url));
        $headers = array(
            'Content-Type: application/pdf',
        );


        if ($documents) {
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
    public function filtrage(Request $request)
    {
        $q = $request->document;
        if ($request->document == 'all') {
            $documents = Document::orderBy('id', 'desc');
            return response()->json([
                "status" => "success",
                "data" => $documents
            ]);
        } elseif ($q) {
            $documents = Document::where('category', $q);
            return response()->json([
                "status" => "success",
                "data" => $documents
            ]);
        }
    }
}