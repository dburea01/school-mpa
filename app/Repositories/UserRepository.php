<?php

declare(strict_types=1);
namespace App\Repositories;

use App\Models\User;
use App\Models\UserGroup;

class UserRepository
{
    public function all(array $request)
    {
        $usersQuery = User::with('role')->with(['user_groups', 'user_subjects'])->orderBy('last_name')->orderBy('first_name');

        if (array_key_exists('user_name', $request) && $request['user_name'] !== null) {
            $usersQuery->where(function ($query) use ($request) {
                $query->where('first_name', 'ilike', '%' . $request['user_name'] . '%')
                    ->orWhere('last_name', 'ilike', '%' . $request['user_name'] . '%')
                    ->orWhere('email', 'ilike', '%' . $request['user_name'] . '%');
            });
        }

        if (array_key_exists('role_id', $request) && $request['role_id'] !== null) {
            $usersQuery->where('role_id', $request['role_id']);
        }

        if (array_key_exists('status', $request) && $request['status'] !== null) {
            $usersQuery->where('status', $request['status']);
        }

        return $usersQuery->paginate();
    }

    public function getExistingUsers(string $lastName, string $firstName)
    {
        return User::where('last_name', 'ilike', $lastName)
            ->where('first_name', 'ilike', $firstName)
            ->get();
    }

    public function update(User $user, array $userData): User
    {
        $user->fill($userData);
        $user->save();

        return $user;
    }

    public function updateUserImage(User $user, string $path): User
    {
        $user->user_image_url = $path;
        $user->save();
        return $user;
    }

    public function destroy(User $user): void
    {
        $user->delete();
    }

    public function insert(array $userData)
    {
        $user = new User();
        $user->fill($userData);
        $user->save();

        return $user;
    }

    public function usersOfAGroup(string $groupId)
    {
        $users = UserGroup::where('group_id', $groupId)->pluck('user_id');

        return User::whereIn('id', $users)->get();
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
