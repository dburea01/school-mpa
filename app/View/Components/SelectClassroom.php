<?php
namespace App\View\Components;

use App\Models\Classroom;
use App\Models\School;
use App\Repositories\PeriodRepository;
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
        $periodRepository = new PeriodRepository();
        $currentPeriod = $periodRepository->getCurrentPeriod();

        $this->classrooms = Classroom::where('period_id', $currentPeriod->id)->orderBy('name')->get();
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
