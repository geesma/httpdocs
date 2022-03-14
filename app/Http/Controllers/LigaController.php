<?php

namespace App\Http\Controllers;

use App\Models\Liga;
use App\Models\Temporada;
use App\Models\User;
use Illuminate\Http\Request;

class LigaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ligas = Liga::all();
        return view("liga.index", compact("ligas"));
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
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'subname' => 'required|max:255',
            'content' => 'required',
            'order' => 'required',
            'color' => 'required',
            'initials' => 'required|max:3'
        ]);
        return Liga::create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Liga  $liga
     * @return \Illuminate\Http\Response
     */
    public function show(Liga $liga)
    {
        $temporada = Temporada::orderBy('nom_any', 'desc')->first();
        $players = User::getTemporadaLigaPlayers($temporada->id, $liga->id);
        return view("liga.view", compact(["liga", 'temporada', 'players']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Liga  $liga
     * @return \Illuminate\Http\Response
     */
    public function edit(Liga $liga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Liga  $liga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Liga $liga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Liga  $liga
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $liga = Liga::findOrFail($id);
        return $liga->delete();
    }
}
