<?php

namespace App\View\Components\Temporada;

use Illuminate\View\Component;

class Card extends Component
{
    public $link;
    public $title;
    public $subtitle;
    public $elements;
    public $id;
    public $delete = true;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($link, $title, $subtitle, $id, $elements, $delete = true)
    {
        $this->link = $link;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->elements = $elements;
        $this->id = $id;
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.temporada.card');
    }
}
