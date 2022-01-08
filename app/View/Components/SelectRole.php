<?php

namespace App\View\Components;

use App\Models\Role;
use Illuminate\View\Component;

class SelectRole extends Component
{
    public $roles;
    public $name;
    public $id;
    public $required = false;
    public $value;
    public $familyRole;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $required, $value, $familyRole)
    {
        $this->roles = Role::where('displayable', true)->where('family_role', $familyRole)->orderBy('position')->get();
        $this->name = $name;
        $this->id = $id;
        $this->required = $required;
        $this->value = $value;
        $this->familyRole = $familyRole;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select-role');
    }
}
