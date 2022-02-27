<?php

namespace App\View\Components\Menu;

use Illuminate\View\Component;

class MobileLink extends Component
{
    public $active;
    public $link;
    public $text;
    public $submenu;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($active, $link, $text, $submenu)
    {
        $this->active = $active;
        $this->link = $link;
        $this->text = $text;
        $this->submenu = $submenu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu.mobile-link');
    }
}
