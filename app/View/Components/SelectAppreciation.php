<?php
namespace App\View\Components;

use App\Models\Civility;
use Illuminate\View\Component;

class SelectAppreciation extends Component
{
    public $appreciations;

    public $name;
    public $placeholder;

    public $required = false;

    public $studentResult;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($appreciations, $placeholder, $name, $required, $studentResult)
    {
        $this->appreciations = $appreciations;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->required = $required;
        $this->studentResult = $studentResult;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-appreciation');
    }
}
