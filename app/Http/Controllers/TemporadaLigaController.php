<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Temporada;
use App\Models\Liga;
use App\Models\User;

class TemporadaLigaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Temporada $temporada)
    {
        return view("temporadesLiga.index", compact('temporada'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Temporada $temporada)
    {
        $ligas = Liga::getLigasToCreateOn($temporada->id);
        return view('temporadesLiga.create', compact(['ligas', 'temporada']));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Temporada $temporada, Liga $liga)
    {
        $users = User::getTemporadaLigaPlayersWithPoints($temporada->id, $liga->id);
        return view("temporadesLiga.view", compact(['temporada', 'liga', 'users']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Temporada $temporada, Liga $liga)
    {
        $players = User::getTemporadaLigaPlayersWithPoints($temporada->id, $liga->id)->toArray();
        $allUsers = User::getNotUsedUsers($temporada->id)->toArray();
        return view("temporadesLiga.edit", compact(['liga', 'temporada','players', 'allUsers']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Temporada $temporada, Liga $liga)
    {
        for($i = 0; $i < count($request->players); $i++) {
            Liga::fillLiga($liga->id, $temporada->id, $request->players[$i]['id'], $request->players[$i]['points']);
        }
        if(isset($request->deletePlayers)){
            for($i = 0; $i < count($request->deletePlayers); $i++) {
                Liga::deleteRowLiga($liga->id, $temporada->id, $request->deletePlayers[$i]);
            }
        }
        return "done";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
