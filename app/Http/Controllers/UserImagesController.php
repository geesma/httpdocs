<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreuserImagesRequest;
use App\Http\Requests\UpdateuserImagesRequest;
use Illuminate\Http\Request;
use App\Models\userImages;
use App\Models\User;

class UserImagesController extends Controller
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
     * @param  \App\Http\Requests\StoreuserImagesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id ,StoreuserImagesRequest $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $data = 'images/uploads/user/user-'.$id.'/';
        $image->move(public_path().'/'.$data,$imageName);

        $imageUpload = new userImages();
        $imageUpload->original_filename = $imageName;
        $imageUpload->user_id = $id;
        $imageUpload->filename = $data.$imageName;
        $imageUpload->likes = 0;
        $imageUpload->save();
        User::set_user_profile_picture($id, $imageUpload->filename);
        return response()->json(['success'=>$imageName]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\userImages  $userImages
     * @return \Illuminate\Http\Response
     */
    public function show(userImages $userImages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\userImages  $userImages
     * @return \Illuminate\Http\Response
     */
    public function edit(userImages $userImages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateuserImagesRequest  $request
     * @param  \App\Models\userImages  $userImages
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateuserImagesRequest $request, userImages $userImages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\userImages  $userImages
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $fileName = 'images/uploads/user/user-'.$id.'/'.$request->filename;
        if(unlink($fileName)) {
            $imageUpload = userImages::where('filename', '=', $fileName)->first();
            $imageUpload->delete();
        } else {
            return response()->json(['message' => 'No existe ninguna imagen con ese nombre'], 409);
        }
        return response()->json(['success'=>$fileName]);
    }
}
