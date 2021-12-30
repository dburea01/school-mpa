<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectUserGenre extends Component
{
    public $name;
    public $id;
    public $required;
    public $genre_id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $required, $genre_id)
    {
        $this->name = $name;
        $this->id = $id;
        $this->required = $required;
        $this->genre_id = $genre_id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-user-genre');
    }
}
