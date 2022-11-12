<?php
namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class SelectTeacher extends Component
{
    public $teachers;

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
        $this->teachers = User::where('role_id', 'TEACHER')->orderBy('last_name')
        ->orderBy('first_name')->get();

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
        return view('components.select-teacher');
    }
}
