<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;
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

    public function update(Group $group, array $groupData)
    {
        $group->fill($groupData);
        $group->save();

        return $group;
    }

    public function destroy(Group $group): void
    {
        $group->delete();
    }

    public function insert($school_id, $groupData)
    {
        $group = new Group();
        $group->school_id = $school_id;
        $group->fill($groupData);
        $group->save();

        return $group;
    }
}
