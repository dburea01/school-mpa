<?php
namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Period;

class ClassroomRepository
{
    public $assignmentRepository;

    public function __construct(AssignmentRepository $assignmentRepository)
    {
        $this->assignmentRepository = $assignmentRepository;
    }

    public function all(string $periodId)
    {
        $classrooms = Classroom::where('period_id', $periodId)
        ->orderBy('name')
        ->get();

        foreach ($classrooms as $classroom) {
            $classroom->assignments = $this->assignmentRepository->index($classroom);
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
