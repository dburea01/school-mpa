<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\InitSubject;
use App\Models\School;
use App\Models\Subject;

class SchoolRepository
{
    public function update(array $schoolData): School
    {
        $school = School::first();
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
