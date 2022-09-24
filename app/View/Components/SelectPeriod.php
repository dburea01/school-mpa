<?php
namespace App\View\Components;

use App\Models\Period;
use App\Models\School;
use Illuminate\View\Component;

class SelectPeriod extends Component
{
    public $school;
    public $periods;
    public $value;
    public $name;
    public $id;
    public $onchange;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(School $school, string $value = null, string $name, string $id, string $onchange = null)
    {
        $this->periods = Period::where('school_id', $school->id)->orderBy('start_date')->get();
        $this->value = $value;
        $this->name = $name;
        $this->id = $id;
        $this->onchange = $onchange;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-period');
    }
}
