<?php
namespace App\View\Components;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class QuantityAssignment extends Component
{
    public $user;
    public $quantityAssignments = 0;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->quantityAssignments = DB::table('periods')
        ->join('classrooms', 'classrooms.period_id', 'periods.id')
        ->join('assignment_teachers', 'assignment_teachers.classroom_id', 'classrooms.id')
        ->where('periods.current', 'true')
        ->where('assignment_teachers.user_id', $user->id)
        ->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.quantity-assignment');
    }
}
