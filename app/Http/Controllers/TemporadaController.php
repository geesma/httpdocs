<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemporadaRequest;
use App\Http\Requests\UpdateTemporadaRequest;
use App\Models\Temporada;
use App\Models\Liga;
use App\Models\User;

class TemporadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $temporadas = Temporada::all();
        return view("temporades.index", compact('temporadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "hola";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTemporadaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemporadaRequest $request)
    {
        $validatedData = $request->validate([
            'nom_temporada' => 'required|max:30',
            'nom_any' => 'required|max:4',
            'content' => 'required',
            'order' => 'required',
        ]);
        return Temporada::create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Http\Response
     */
    public function show(Temporada $temporada)
    {
        return view("temporades.view", compact('temporada'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Http\Response
     */
    public function edit(Temporada $temporada)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTemporadaRequest  $request
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTemporadaRequest $request, Temporada $temporada)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $temporada = Temporada::findOrFail($id);

        return $temporada->delete();
    }

    public function historico() {
        $data = User::get_historical_data();
        return view("temporades.historico", compact(['data']));
    }

    public function past_champions() {
        $ligas = Liga::all();
        return view('temporades.pastChampions', compact(['ligas']));
    }
}
