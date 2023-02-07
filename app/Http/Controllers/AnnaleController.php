<?php

namespace App\Http\Controllers;

use App\Models\Annale;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class AnnaleController extends Controller
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
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'required',
            'pdf' => 'required',
        ]);

        $annale = new Annale();
        $annale->title = $request->title;
        $annale->author = $request->author;
        $annale->description = $request->description;
        if ($request->image) {
            $file = $request->file('image');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $imagePath =  $file->storeAs(
                'public/annales/images',
                $imageName,
               
            );
            $annale->image = Storage::url($imagePath);
        };
        if ($request->pdf) {
            $file = $request->file('pdf');
            $pdfName = time() . '.' . $file->getClientOriginalExtension();
            $pdfPath =  $file->storeAs(
                'public/annales/pdfs',
                $pdfName,
               
            );
            $annale->pdf = Storage::url($pdfPath);
        };
        $annale->save();



        return response()->json([
            "status" => "success",
            "message" => "Annale enrégistrée avec succès"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annale  $annale
     * @return \Illuminate\Http\Response
     */
    public function show(Annale $annale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Annale  $annale
     * @return \Illuminate\Http\Response
     */
    public function edit(Annale $annale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annale  $annale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annale $annale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annale  $annale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annale $annale)
    {
        //
    }
}