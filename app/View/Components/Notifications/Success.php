<?php

namespace App\View\Components\Notifications;

use Illuminate\View\Component;

class Success extends Component
{
    public $type;
    public $message;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications.success', ['message' => $this->message, 'type' => $this->type]);
    }
}
