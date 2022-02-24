<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use Illuminate\Http\Request;

class HistoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('historia.index', ['historia' => Historia::find(1)]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Historia  $historia
     * @return \Illuminate\Http\Response
     */
    public function show(Historia $historia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Historia  $historia
     * @return \Illuminate\Http\Response
     */
    public function edit(Historia $historia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Historia  $historia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Historia $historia)
    {
        $nova_historia = Historia::find(1);
        $nova_historia->content = $request->content;
        return $nova_historia->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Historia  $historia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Historia $historia)
    {
        //
    }
}
