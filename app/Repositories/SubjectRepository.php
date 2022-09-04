<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\School;
use App\Models\Subject;

class SubjectRepository
{
    public function all($school)
    {
        return Subject::where('school_id', $school->id)->orderBy('name->App::getLocale()')->get();
    }

    public function update(Subject $subject, array $data)
    {
        $subject->fill($data);
        $subject->save();

        return $subject;
    }

    public function destroy(Subject $subject): void
    {
        $subject->delete();
    }

    public function insert(School $school, array $data)
    {
        $subject = new Subject();
        $subject->school_id = $school->id;
        $subject->fill($data);
        $subject->save();

        return $subject;
    }
}
