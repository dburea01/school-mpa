<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\School;

class SchoolRepository
{
    public function all($request)
    {
        $query = School::orderBy('name')->withCount(['users', 'groups', 'subjects', 'periods']);

        if (\array_key_exists('school_name', $request)) {
            $query->where('name', 'ilike', '%'.$request['school_name'].'%');
        }

        if (\array_key_exists('city', $request)) {
            $query->where('city', 'ilike', '%'.$request['city'].'%');
        }

        return $query->paginate(10);
    }

    public function update($schoolId, array $schoolData)
    {
        $school = School::find($schoolId);
        $school->fill($schoolData);
        $school->save();

        return $school;
    }

    public function destroy($schoolId): void
    {
        School::destroy($schoolId);
    }

    public function insert($schoolData)
    {
        $school = new School();
        $school->fill($schoolData);
        $school->save();

        return $school;
    }
}
