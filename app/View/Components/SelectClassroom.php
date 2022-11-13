<?php
namespace App\View\Components;

use App\Repositories\PeriodRepository;
use App\Repositories\ClassroomRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SelectClassroom extends Component
{
    public $classrooms;

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
        $classroomRepository = new ClassroomRepository();

        $this->classrooms = $classroomRepository->getAuthorizedClassrooms(Auth::user());
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
        return view('components.select-classroom');
    }
}
