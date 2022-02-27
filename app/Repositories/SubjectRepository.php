<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubjectRepository
{
    public function all($school)
    {
        return Subject::where('school_id', $school->id)->orderBy('name')->get();
    }

    public function get($groupId, array $request): void
    {
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
