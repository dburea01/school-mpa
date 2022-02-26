<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
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

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Subject $subject)
    {
        //
    }
}
