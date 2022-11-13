<?php
namespace App\Repositories;

use App\Models\AssignmentTeacher;
use App\Models\Classroom;
use App\Models\Period;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ClassroomRepository
{
    public function all(string $periodId)
    {
        $classrooms = Classroom::where('period_id', $periodId)
        ->orderBy('name')
        ->get();

        $assignmentStudentRepository = new AssignmentStudentRepository();
        foreach ($classrooms as $classroom) {
            $classroom->assignment_students = $assignmentStudentRepository->index($classroom);
        }

        return $classrooms;
    }

    public function getAuthorizedClassrooms(User $user)
    {
        $query = DB::table('periods')
            ->join('classrooms', 'periods.id', 'classrooms.period_id')
            ->where('periods.current', 'true')
            ->distinct()
            ->select('classrooms.*');

        // A teacher can see only the classrooms in which he is assigned.
        if ($user->isTeacher()) {
            $query->join('assignment_teachers', function ($join) use ($user) {
                $join->on('assignment_teachers.classroom_id', 'classrooms.id')
                ->where('assignment_teachers.user_id', $user->id);
            });
        }

        return $query->get();
    }

    public function update(Classroom $classroom, array $data): Classroom
    {
        $classroom->fill($data);
        $classroom->save();

        return $classroom;
    }

    public function destroy(Classroom $classroom): void
    {
        $classroom->delete();
    }

    public function insert(array $data): Classroom
    {
        $classroom = new Classroom();
        $classroom->fill($data);
        $classroom->save();

        return $classroom;
    }
}
