<?php

namespace App\View\Components;

use App\Models\School;
use App\Models\Subject;
use Illuminate\View\Component;

class SelectSubject extends Component
{
    public $subjects;

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
    public function __construct(School $school, $name, $id, $required, $value, $placeholder = '')
    {
        $this->subjects = Subject::where('school_id', $school->id)->orderBy('short_name')->get();
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
        return view('components.select-subject');
    }
}
