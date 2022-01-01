<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;

class GroupRepository
{
    public function all($school_id, $request)
    {
        $groupsQuery = Group::where('school_id', $school_id)->orderBy('name');

        if (array_key_exists('name', $request) && $request['name'] !== null && strlen($request['name']) > 1) {
            $groupsQuery->where('name', $request['name']);
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

    public function insert($school_id, $userData)
    {
        $user = new User();
        $user->school_id = $school_id;
        $user->fill($userData);
        $user->save();

        return $user;
    }
}
