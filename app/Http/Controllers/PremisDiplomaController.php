<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Premio;
use App\Models\PremisDiploma;

class PremisDiplomaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Premio $premio,Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $data = 'images/uploads/premi-diploma/premio-'.$premio->id.'/';
        $image->move(public_path().'/'.$data,$imageName);

        $imageUpload = new PremisDiploma();
        $imageUpload->original_filename = $imageName;
        $imageUpload->premios_id = $premio->id;
        $imageUpload->filename = $data.$imageName;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Premio $premio, Request $request)
    {
        $fileName = 'images/uploads/premi-diploma/temporada-'.$premio->id.'/'.$request->filename;
        if(unlink($fileName)) {
            $imageUpload = PremisDiploma::where('filename', '=', $fileName)->first();
            $imageUpload->delete();
        } else {
            return response()->json(['message' => 'No existe ninguna imagen con ese nombre'], 409);
        }
        return response()->json(['success'=>$fileName]);
    }
}
