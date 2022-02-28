<?php

namespace App\View\Components\PageParts;

use Illuminate\Http\Request;
use Illuminate\View\Component;

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
        if(empty($page)) {
            $page= explode('/', $_SERVER['REQUEST_URI'])[1];
        }
        $this->menu = [
            ["Historia", $page == 'historia', "historia.index"],
            ["Nuestras ligas", $page == 'ligas', "user.all", [
                ["Lliga Rectoret", route("temporada.index")],
                ["Lliga Future", route("temporada.index")],
                ["Lliga Inferno", route("temporada.index")]
            ]],
            ["Clasificación", $page == 'clasificacion', "user.all", [
                ["Lliga Rectoret", route("temporada.index")],
                ["Lliga Future", route("temporada.index")],
                ["Lliga Inferno", route("temporada.index")],
                ["Histórico", route("temporada.index")],
                ['Temporadas', route("temporada.index")]
            ]],
            ["Galeria", $page == 'galeria', "user.all", [
                ["Temporada 2016/2017", route('temporada.index')],
                ["Temporada 2017/2018", route('temporada.index')],
                ["Temporada 2018/2019", route('temporada.index')],
                ["Temporada 2020/2021", route('temporada.index')],
                ["Temporada 2021/2022", route('temporada.index')]
            ]],
            ["Álbum", $page == 'album', "user.all"],
            ["Estatutos", $page == 'estatutos', "user.all"],
            ["Premios", $page == 'premios', "user.all", [
                ["Past Champions", route('temporada.index')],
                ["Premios", route('temporada.index'),[
                    ["Premios 3a Gala", route('temporada.index')],
                    ["Premios 4a Gala", route('temporada.index')],
                    ["Premios 5a Gala", route('temporada.index')]
                ]],
                ["Diplomas", route('temporada.index'), [
                    ["Temporada 2019/2020", route('temporada.index')],
                    ["Temporada 2020/2021", route('temporada.index')]
                ]]
            ]]
          ];
        $this->admin_menu = [
            ["Usuarios", route("user.all"), "editor"],
            ["Ligas", "#", "editor"],
            ["Reportes", "#", "moderator"]
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
