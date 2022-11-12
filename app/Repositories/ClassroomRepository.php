<?php
namespace App\Repositories;

use App\Models\Classroom;

class ClassroomRepository
{
    public $assignmentStudentRepository;

    public function __construct(AssignmentStudentRepository $assignmentStudentRepository)
    {
        $this->assignmentStudentRepository = $assignmentStudentRepository;
    }

    public function all(string $periodId)
    {
        $classrooms = Classroom::where('period_id', $periodId)
        ->orderBy('name')
        ->get();

        foreach ($classrooms as $classroom) {
            $classroom->assignment_students = $this->assignmentStudentRepository->index($classroom);
        }

        return $classrooms;
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
