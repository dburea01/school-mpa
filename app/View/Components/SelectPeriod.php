<?php
namespace App\View\Components;

use App\Models\Period;
use Illuminate\View\Component;

class SelectPeriod extends Component
{
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
    public function __construct(string $name, string $id, int $value = null, string $onchange = null)
    {
        $this->periods = Period::orderBy('start_date')->get();
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
