<?php

namespace App\View\Components;

use App\Models\Country;
use Illuminate\View\Component;

class SelectCountry extends Component
{
    public $countries;

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
        $this->countries = Country::orderBy('name')->get();
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
        return view('components.select-country');
    }
}
