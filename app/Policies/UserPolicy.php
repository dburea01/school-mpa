<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    protected $school;

    public function __construct()
    {
        $this->school = request()->route()->parameter('school');
    }

    public function before(User $user)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return ($user->isDirector() && $user->school_id === $this->school->id);
    }

    public function view(User $user, User $model)
    {
        return ($user->isDirector() && $user->school_id === $model->school_id);
    }

    public function create(User $user)
    {
        return ($user->isDirector() && $user->school_id === $this->school->id);
    }

    public function update(User $user, User $model)
    {
        return ($user->isDirector() && $user->school_id === $model->school_id);
    }

    public function delete(User $user, User $model)
    {
        return ($user->isDirector() && $user->school_id === $model->school_id);
    }
}
