<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\InitSubject;
use App\Models\School;
use App\Models\Subject;

class SchoolRepository
{
    public function all($request)
    {
        $query = School::orderBy('name')->withCount(['users', 'groups', 'subjects', 'periods']);

        if (\array_key_exists('school_name', $request)) {
            $query->where('name', 'ilike', '%' . $request['school_name'] . '%');
        }

        if (\array_key_exists('city', $request)) {
            $query->where('city', 'ilike', '%' . $request['city'] . '%');
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

    public function initSubjects(School $school): void
    {
        $initSubjects = InitSubject::where('status', 'ACTIVE')->get();

        foreach ($initSubjects as $initSubject) {
            $subject = new Subject();

            $subject->school_id = $school->id;
            $subject->short_name = $initSubject->short_name;
            $subject->name = $initSubject->getTranslations('name');
            $subject->position = $initSubject->position;
            $subject->status = $initSubject->status;
            $subject->comment = $initSubject->comment;
            $subject->save();
        }
    }
}
