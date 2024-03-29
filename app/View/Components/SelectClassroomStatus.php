<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectClassroomStatus extends Component
{
    public $name;

    public $id;

    public $required;

    public $status;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $required, $status)
    {
        $this->name = $name;
        $this->id = $id;
        $this->required = $required;
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-classroom-status');
    }
}
