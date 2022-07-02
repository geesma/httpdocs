<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstatutoRequest;
use App\Http\Requests\UpdateEstatutoRequest;
use App\Http\Controllers\Request;
use App\Models\Estatuto;

class EstatutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estatuto = Estatuto::find(1);
        return view('estatuto.index', compact('estatuto'));
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
     * @param  \App\Http\Requests\StoreEstatutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEstatutoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estatuto  $estatuto
     * @return \Illuminate\Http\Response
     */
    public function show(Estatuto $estatuto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estatuto  $estatuto
     * @return \Illuminate\Http\Response
     */
    public function edit(Estatuto $estatuto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEstatutoRequest  $request
     * @param  \App\Models\Estatuto  $estatuto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEstatutoRequest $request, Estatuto $estatuto)
    {
        $nova_historia = Estatuto::find(1);
        $nova_historia->content = $request->content;
        $nova_historia->temporada_id = 1;
        return $nova_historia->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estatuto  $estatuto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estatuto $estatuto)
    {
        //
    }
}
