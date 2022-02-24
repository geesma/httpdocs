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
            ["Nuestras ligas", $page == 'ligas', "user.all"],
            ["Clasificación", $page == 'clasificacion', "user.all"],
            ["Galeria", $page == 'galeria', "user.all"],
            ["Álbum", $page == 'album', "user.all"],
            ["Estatutos", $page == 'estatutos', "user.all"],
            ["Premios", $page == 'premios', "user.all"]
          ];
        $this->admin_menu = [
            ["Usuarios", route("user.all")]
          ];
        $this->user_menu = [
            ["Tu usuario", route('user.view', ['id' => $request->session()->get('user')->id])],
            ["Configuracion", "#"],
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
