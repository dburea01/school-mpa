<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    protected $school;

    protected $group;

    public function __construct()
    {
        $this->school = request()->route()->parameter('school');
        $this->group = request()->route()->parameter('group');
    }

    public function before(User $user)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->isDirector() && $user->school_id === $this->school->id;
    }

    public function create(User $user)
    {
        return $user->isDirector() && $user->school_id === $this->school->id;
    }

    public function update(User $user, Group $group)
    {
        return $user->isDirector() &&
            $user->school_id === $this->school->id &&
            $this->school->id === $group->school_id;
    }

    public function delete(User $user, Group $group)
    {
        return $user->isDirector() &&
            $user->school_id === $this->school->id &&
            $this->school->id === $group->school_id;
    }
}
