<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function upload(Request $request) {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $fileName = 'historia-'.uniqid().'.'.$extension;
        $data = 'images/uploads/historia/';
        $file->move(public_path().'/'.$data,$fileName);
        return response()->json(['location'=>$data.$fileName]);
    }
}
