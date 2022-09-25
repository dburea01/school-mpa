<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;

class GroupRepository
{
    public function all($schoolId, $request)
    {
        $groupsQuery = Group::where('school_id', $schoolId)->withCount('user_groups')->orderBy('name');

        if (array_key_exists('group_name', $request)
            && $request['group_name'] !== null
            && strlen($request['group_name']) > 1) {
            $groupsQuery->where('name', 'ilike', '%'.$request['group_name'].'%');
        }

        if (array_key_exists('group_city', $request)
            && $request['group_city'] !== null
            && strlen($request['group_city']) > 1) {
            $groupsQuery->where('city', 'ilike', '%'.$request['group_city'].'%');
        }

        return $groupsQuery->paginate(10);
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

    public function insert($schoolId, $groupData)
    {
        $group = new Group();
        $group->school_id = $schoolId;
        $group->fill($groupData);
        $group->save();

        return $group;
    }
}
