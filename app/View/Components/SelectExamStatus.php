<?php

namespace App\View\Components;

use App\Models\ExamStatus;
use Illuminate\View\Component;

class SelectExamStatus extends Component
{
    public $examStatus;

    public $name;

    public $id;

    public $required = false;

    public $value;

    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $required, $value, $placeholder = '')
    {
        $this->examStatus = ExamStatus::orderBy('position')->get();
        $this->name = $name;
        $this->id = $id;
        $this->required = $required;
        $this->value = $value;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-exam-status');
    }
}
