<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Temporada;
use App\Models\Liga;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ligas = Liga::all();
        $temporadas = Temporada::all();
        return view('post.create', compact(['ligas', 'temporadas']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:40',
            'subtitulo' => 'max:100',
            'image' => 'image|max:2000|mimes:jpg,png,jpeg'
        ]);
        $post = new Post;
        $post->user_id = session()->get('user')->id;
        $post->title = $request->titulo;
        $post->subtitle = $request->subtitulo;
        $post->content = $request->content;
        if(isset($request->liga) && isset($request->temporada) && $request->liga != 0 && $request->temporada != 0) {
            $users = User::getTemporadaLigaPlayersWithPoints($request->temporada, $request->liga);
            $users->toJson();
            $post->qualification = $users;
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $request->image->getClientOriginalExtension();
            $fileName = 'post-'.uniqid().'.'.$extension;
            $data = 'images/uploads/post/';
            $file->move(public_path().'/'.$data,$fileName);
            $post->image = $data.$fileName;
        }
        $post->save();
        return redirect()->route("post.index")->with('status', ['type'=>"success" , 'message' =>"El post ".$post->title. " se ha creado correctamente"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.view', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
