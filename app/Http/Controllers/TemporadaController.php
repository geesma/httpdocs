<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTemporadaRequest;
use App\Http\Requests\UpdateTemporadaRequest;
use App\Models\Temporada;

class TemporadaController extends Controller
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
     * @param  \App\Http\Requests\StoreTemporadaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTemporadaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Temporada  $temporada
     * @return \Illuminate\Http\Response
     */
    public function show(Temporada $temporada)
    {
        //
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
    public function destroy(Temporada $temporada)
    {
        //
    }
}
