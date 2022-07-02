<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use App\Models\Album;
use App\Models\Temporada;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temporadas = Temporada::all();
        return view('album.index', compact(['temporadas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Temporada $temporada)
    {
        return view('album.create', compact('temporada'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAlbumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbumRequest $request, Temporada $temporada)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:40',
            'subtitulo' => 'max:100',
            'album' => 'required|mimetypes:application/pdf|max:800000'
        ]);
        $album = new Album;
        $album->title = $request->titulo;
        $album->subtitle = $request->subtitulo;
        $album->content = $request->content;
        $album->temporada_id = $temporada->id;
        $album->likes = 0;
        if ($request->hasFile('album')) {
            $file = $request->file('album');
            $extension = ".pdf";
            $fileName = 'album-'.uniqid().'.'.$extension;
            $data = 'images/uploads/album/temporada-'.$temporada->id."/";
            $file->move(public_path().'/'.$data,$fileName);
            $album->original_filename = $file->getClientOriginalName();
            $album->filename = $data.$fileName;
        }
        $album->save();
        return redirect()->route("album.index")->with('status', ['type'=>"success" , 'message' =>"El album ".$album->title. " se ha creado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Temporada $temporada)
    {
        $album = Album::where('temporada_id', $temporada->id)->first();
        return view('album.view', compact(['temporada','album']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlbumRequest  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {

    }
}
