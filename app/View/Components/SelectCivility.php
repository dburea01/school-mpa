<?php

namespace App\View\Components;

use App\Models\Civility;
use Illuminate\View\Component;

class SelectCivility extends Component
{
    public $civilities;

    public $name;

    public $id;

    public $required = false;

    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $required, $value)
    {
        $this->civilities = Civility::where('is_active', true)->orderBy('position')->get();
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
        return view('components.select-civility');
    }
}
