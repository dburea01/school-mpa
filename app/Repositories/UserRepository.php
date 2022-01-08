<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function all($school_id, $request)
    {
        $usersQuery = User::where('school_id', $school_id)
        ->whereNotIn('role_id', ['PARENT', 'STUDENT'])
        ->with('role')
        ->orderBy('last_name');

        if (array_key_exists('user_name', $request) && $request['user_name'] !== null && strlen($request['user_name']) > 1) {
            $usersQuery->where(function ($query) use ($request) {
                $query->where('first_name', 'ilike', '%' . $request['user_name'] . '%')
                      ->orWhere('last_name', 'ilike', '%' . $request['user_name'] . '%');
            });
        }

        if (array_key_exists('role_id', $request) && $request['role_id'] !== null) {
            $usersQuery->where('role_id', $request['role_id']);
        }

        return $usersQuery->paginate(10);
    }

    public function summaryUsersByRole(School $school)
    {
        return DB::table('users')
        ->select(DB::raw('count(*) as user_count, role_id'))
        ->where('school_id', $school->id)
        ->groupBy('role_id')
        ->get();
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

    public function insert($school_id, string $group_id = null, $userData)
    {
        $user = new User();
        $user->school_id = $school_id;
        $user->group_id = $group_id;
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
