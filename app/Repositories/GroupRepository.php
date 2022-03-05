<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class GroupRepository
{
    public function all($school_id, $request)
    {
        $groupsQuery = Group::where('school_id', $school_id)->withCount('user_groups')->orderBy('name');

        if (array_key_exists('group_name', $request) && $request['group_name'] !== null && strlen($request['group_name']) > 1) {
            $groupsQuery->where('name', 'ilike', '%' . $request['group_name'] . '%');
        }

        if (array_key_exists('group_city', $request) && $request['group_city'] !== null && strlen($request['group_city']) > 1) {
            $groupsQuery->where('city', 'ilike', '%' . $request['group_city'] . '%');
        }

        return $groupsQuery->paginate(10);
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
