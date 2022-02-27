<?php

namespace App\View\Components\Menu;

use Illuminate\View\Component;

class SubmenuLink extends Component
{
    public $link;
    public $text;
    public $menuName;
    public $elementId;
    public $subMenu;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $text, $menuName, $elementId, $subMenu)
    {
        $this->link = $link;
        $this->text = $text;
        $this->menuName = $menuName;
        $this->elementId = $elementId;
        $this->subMenu = $subMenu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu.submenu-link');
    }
}
