<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;

class AssignmentRepository
{
    public function index(School $school, Classroom $classroom)
    {
        $assignments = Assignment::where('school_id', $school->id)
        ->where('classroom_id', $classroom->id)
        ->with('user')
        ->get();

        return $assignments->filter(function ($assignment) {
            return $assignment->user->role_id === 'STUDENT';
        })
        ->sortBy('user.last_name');
    }

    public function destroy(Assignment $assignment): void
    {
        $assignment->delete();
    }

    public function insert(School $school, Classroom $classroom, User $userToAssign): Assignment
    {
        return Assignment::create([
            'school_id' => $school->id,
            'classroom_id' => $classroom->id,
            'user_id' => $userToAssign->id,
        ]);
    }
}
