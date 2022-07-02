<?php

namespace App\View\Components\PageParts;

use Illuminate\Http\Request;
use Illuminate\View\Component;
use App\Models\Temporada;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;

class Header extends Component
{
    public $page;
    public $menu;
    public $admin_menu;
    public $user_menu;
    public $notifications;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page, Request $request)
    {
        $last_season = Temporada::orderBy('nom_any', 'desc')->distinct()->first();
        $seasons = Temporada::orderBy('nom_any', 'asc')->distinct()->get();
        $galeries = Gallery::orderBy('temporada_id', 'asc')->groupBy('temporada_id')->distinct()->get();
        $current_season_array = array();
        $current_season_ligues_array = array();
        $seasons_array = array();
        $albums_array = array();
        $galleries_array = array();
        if(empty($page)) {
            $page= explode('/', $_SERVER['REQUEST_URI'])[1];
        }
        $this->menu = [
            ["Historia", $page == 'historia', "historia.index"],
            ["Nuestras ligas", $page == 'ligas', "user.all", []],
            ["Clasificación", $page == 'clasificacion', "user.all", []],
            ["Galeria", $page == 'galeria', "user.all", []],
            ["Álbum", $page == 'album', "album.index", []],
            ["Estatutos", $page == 'estatutos', "estatuto.index"],
            ["Premios", $page == 'premios', "user.all", [
                ["Past Champions", route('temporada.pastChampions')],
                ["Premios", route('temporada.index'),[['prueba1', route('temporada.index')]]],
                // ["Diplomas", route('temporada.index'), [
                //     ["Temporada 2019/2020", route('temporada.index')],
                //     ["Temporada 2020/2021", route('temporada.index')]
                // ]]
            ]]
          ];

        /* Add ligas to nuestras_ligas */

        foreach($last_season->ligas()->groupBy('liga_id')->get() as $liga) {
            array_push($current_season_array, [$liga->name, route("liga.show", ["liga" => $liga])]);
            array_push($current_season_ligues_array, [$liga->name, route("temporada.liga.show", ["temporada" => $last_season,"liga" => $liga])]);
        }

        $this->menu[1][3] = $current_season_array;

        array_push($current_season_ligues_array, ["Histórico", route("temporada.historico")]);
        array_push($current_season_ligues_array, ["Temporadas", route("temporada.index")]);

        $this->menu[2][3] = $current_season_ligues_array;

        foreach($galeries as $gallery) {
            array_push($galleries_array, [$gallery->temporada->nom_temporada, route("temporada.galeria.index", ["temporada" => $gallery->temporada])]);
        }

        $this->menu[3][3] = $galleries_array;

        foreach($seasons as $seasion) {
            if(count($seasion->albums) > 0)
                array_push($albums_array, [$seasion->nom_temporada, route('album.show', ['temporada' => $seasion])]);
        }

        $this->menu[4][3] = $albums_array;

        $this->admin_menu = [
            ["Usuarios", route("user.all"), "editor"],
            ["Ligas", route('liga.index'), "editor"],
            ["Temporadas", route("temporada.index"), "editor"],
            ["Galerias", route('temporada.createGaleria'), "editor"],
            ["Albumes", route('album.index'), "editor"],
            ["Reportes", route('post.create'), "moderator"]
          ];
        $this->user_menu = [
            ["Tu usuario", route('user.view', ['id' => $request->session()->get('user')->id])],
            ["Página de bienvenida", "#"],
            ["Cerrar sesión",  route('user.logoff')]
        ];


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.page-parts.header');
    }
}
