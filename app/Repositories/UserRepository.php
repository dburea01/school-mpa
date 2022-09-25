<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;
use App\Models\UserGroup;

class UserRepository
{
    public function all($schoolId, $request)
    {
        $usersQuery = User::where('school_id', $schoolId)->with('role')->with('user_groups')->orderBy('last_name');

        if (array_key_exists('user_name', $request) && $request['user_name'] !== null) {
            $usersQuery->where(function ($query) use ($request) {
                $query->where('first_name', 'ilike', '%'.$request['user_name'].'%')
                    ->orWhere('last_name', 'ilike', '%'.$request['user_name'].'%')
                    ->orWhere('email', 'ilike', '%'.$request['user_name'].'%');
            });
        }

        if (array_key_exists('role_id', $request) && $request['role_id'] !== null) {
            $usersQuery->where('role_id', $request['role_id']);
        }

        if (array_key_exists('status', $request) && $request['status'] !== null) {
            $usersQuery->where('status', $request['status']);
        }

        return $usersQuery->paginate(10);
    }

    public function getExistingUsers(string $schoolId, string $lastName, string $firstName)
    {
        return User::where('school_id', $schoolId)
            ->where('last_name', 'ilike', $lastName)
            ->where('first_name', 'ilike', $firstName)
            ->get();
    }

    public function update(User $user, array $userData)
    {
        $user->fill($userData);
        $user->save();

        return $user;
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }

    public function insert($schoolId, $userData)
    {
        $user = new User();
        $user->school_id = $schoolId;
        $user->fill($userData);
        $user->save();

        return $user;
    }

    public function usersOfAGroup(string $schoolId, string $groupId)
    {
        $users = UserGroup::where('group_id', $groupId)->pluck('user_id');

        return User::where('school_id', $schoolId)
            ->whereIn('id', $users)->get();
    }

    public function addUserForAGroup(string $groupId, string $userId): UserGroup
    {
        return UserGroup::create([
            'user_id' => $userId,
            'group_id' => $groupId,
        ]);
    }

    public function removeUserFromAGroup(string $groupId, string $userId)
    {
        UserGroup::where('user_id', $userId)->where('group_id', $groupId)->delete();
    }
}
