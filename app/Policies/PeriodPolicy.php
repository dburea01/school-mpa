<?php

namespace App\Policies;

use App\Models\Period;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PeriodPolicy
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
        return $user->isDirector() && $user->school_id === $this->school->id;
    }

    public function view(User $user, Period $period)
    {
        return $user->isDirector() && $user->school_id === $period->school_id;
    }

    public function create(User $user)
    {
        return $user->isDirector() && $user->school_id === $this->school->id;
    }

    public function update(User $user, Period $period)
    {
        return $user->isDirector() && $user->school_id === $period->school_id;
    }

    public function delete(User $user, Period $period)
    {
        return $user->isDirector() && $user->school_id === $period->school_id;
    }
}
