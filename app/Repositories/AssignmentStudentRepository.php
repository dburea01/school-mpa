<?php
namespace App\Repositories;

use App\Models\AssignmentStudent;
use App\Models\Classroom;
use App\Models\User;

class AssignmentStudentRepository
{
    public function index(Classroom $classroom)
    {
        $assignmentStudents = AssignmentStudent::where('classroom_id', $classroom->id)
        ->with('user')
        ->get();

        return $assignmentStudents;
    }

    public function destroy(AssignmentStudent $assignmentStudent): void
    {
        $assignmentStudent->delete();
    }

    public function insert(Classroom $classroom, User $userToAssign): AssignmentStudent
    {
        return AssignmentStudent::create([
            'classroom_id' => $classroom->id,
            'user_id' => $userToAssign->id,
        ]);
    }
}
