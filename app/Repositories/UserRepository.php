<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function all($school_id, $request)
    {
        $usersQuery = User::where('school_id', $school_id)->orderBy('last_name');

        if (array_key_exists('user_name', $request) && $request['user_name'] !== null && strlen($request['user_name']) > 1) {
            $usersQuery->where(function ($query) use ($request) {
                $query->where('first_name', 'ilike', '%' . $request['user_name'] . '%')
                      ->orWhere('last_name', 'ilike', '%' . $request['user_name'] . '%');
            });
        }

        if (array_key_exists('role_id', $request) && $request['role_id'] !== null) {
            $usersQuery->where('role_id', $request['role_id']);
        }

        if (\array_key_exists('sort', $request)) {
            $query->orderBy($request['sort']);
        }

        if (\array_key_exists('desc', $request)) {
            $query->orderBy($request['desc'], 'desc');
        }

        if (\array_key_exists('fields', $request)) {
            $fields = explode(',', $request['fields']);
            foreach ($fields as $field) {
                if ('users_count' === $field) {
                    $query->withCount('users');
                } else {
                    $query->addSelect(trim($field));
                }
            }
        }

        return $usersQuery->paginate(10);
    }

    public function get($schoolId, array $request): void
    {
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

    public function insert($school_id, $userData)
    {
        $user = new User();
        $user->school_id = $school_id;
        $user->fill($userData);
        $user->save();

        return $user;
    }

    public function usersOfAGroup(string $schoolId, string $groupId)
    {
        $users = User::where('school_id', $schoolId)->where('group_id', $groupId)->get();

        return $users;
    }
}
