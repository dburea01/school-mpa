<?php
namespace App\Repositories;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;

class AssignmentRepository
{
    public function index(Classroom $classroom)
    {
        $assignments = Assignment::where('classroom_id', $classroom->id)
        ->with('user')
        ->get();

        return $assignments->sortBy('user.last_name');

        return $assignments->filter(function ($assignment) {
            return $assignment->user->role_id === 'STUDENT';
        })
        ->sortBy('user.last_name');
    }

    public function destroy(Assignment $assignment): void
    {
        $assignment->delete();
    }

    public function insert(Classroom $classroom, User $userToAssign): Assignment
    {
        return Assignment::create([
            'classroom_id' => $classroom->id,
            'user_id' => $userToAssign->id,
        ]);
    }
}
