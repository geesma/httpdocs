<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Temporada;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Temporada $temporada)
    {
        $images = Gallery::where('temporada_id', '=', $temporada->id)->get();
        return view('galeria.index', compact(['images', 'temporada']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Temporada $temporada)
    {
        $images = Gallery::where('temporada_id', '=', $temporada->id)->get();
        return view('galeria.edit', compact(['images', 'temporada']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Temporada $temporada,Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $data = 'images/uploads/gallery/temporada-'.$temporada->id.'/';
        $image->move(public_path().'/'.$data,$imageName);

        $imageUpload = new Gallery();
        $imageUpload->original_filename = $imageName;
        $imageUpload->temporada_id = $temporada->id;
        $imageUpload->filename = $data.$imageName;
        $imageUpload->likes = 0;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Temporada $temporada)
    {
        $images = Gallery::where('temporada_id', '=', $temporada->id)->get();
        return view('galeria.edit', compact(['images', 'temporada']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Temporada $temporada, Request $request)
    {
        $fileName = 'images/uploads/gallery/temporada-'.$temporada->id.'/'.$request->filename;
        if(unlink($fileName)) {
            $imageUpload = Gallery::where('filename', '=', $fileName)->first();
            $imageUpload->delete();
        } else {
            return response()->json(['message' => 'No existe ninguna imagen con ese nombre'], 409);
        }
        return response()->json(['success'=>$fileName]);
    }

    public function createGaleria() {
        $temporadas = Temporada::all();
        return view('galeria.create', compact('temporadas'));
    }
}
