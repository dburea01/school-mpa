<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\Classroom;
use App\Models\Period;
use App\Models\School;

class ClassroomRepository
{
    public function all(School $school, Period $period)
    {
        return Classroom::where('school_id', $school->id)
        ->where('period_id', $period->id)
        ->withCount(['assignments'])
        ->orderBy('name')->get();
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

    public function insert(School $school, array $data): Classroom
    {
        $classroom = new Classroom();
        $classroom->school_id = $school->id;
        $classroom->fill($data);
        $classroom->save();

        return $classroom;
    }

    public function setCurrentPeriod(string $schoolId, string $periodId): Period
    {
        Period::where('school_id', $schoolId)->update(['current' => false]);

        $newCurrentPeriod = Period::where('school_id', $schoolId)->where('id', $periodId)->first();
        $newCurrentPeriod->current = true;
        $newCurrentPeriod->save();

        return $newCurrentPeriod;
    }
}
