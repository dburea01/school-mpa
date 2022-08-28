<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectUserGender extends Component
{
    public $name;

    public $id;

    public $required;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $required, $value)
    {
        $this->name = $name;
        $this->id = $id;
        $this->required = $required;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-user-gender');
    }
}
