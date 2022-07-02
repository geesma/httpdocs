<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePremioRequest;
use App\Http\Requests\UpdatePremioRequest;
use App\Models\Premio;

class PremioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $premios = Premio::all();
        $temporadas = \App\Models\Temporada::all();
        return view('premio.index', compact(['premios', 'temporadas']));
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
     * @param  \App\Http\Requests\StorePremioRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePremioRequest $request)
    {
        $premio = new Premio();
        $premio->fill($request->all());
        $premio->save();
        return $premio;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function show(Premio $premio)
    {
        return view('premio.show', compact(['premio']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function edit(Premio $premio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePremioRequest  $request
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePremioRequest $request, $id)
    {
        $nova_historia = Premio::find($id);
        $nova_historia->content = $request->content;
        return $nova_historia->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Premio  $premio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $premio = Premio::findOrFail($id);
        return $premio->delete();
    }
}
