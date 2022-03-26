<?php
namespace App\Policies;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassroomPolicy
{
    use HandlesAuthorization;

    protected $school;
    protected $classroom;

    public function __construct()
    {
        $this->school = request()->route()->parameter('school');
        $this->classroom = request()->route()->parameter('classroom');
    }

    public function before(User $user)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return ($user->isDirector() && $user->school_id === $this->school->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return ($user->isDirector() && $user->school_id === $this->school->id);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Classroom $classroom)
    {
        return ($user->isDirector() &&
            $user->school_id === $this->school->id &&
            $this->school->id === $classroom->school_id
        );
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Classroom $classroom)
    {
        return ($user->isDirector() &&
            $user->school_id === $this->school->id &&
            $this->school->id === $classroom->school_id
        );
    }
}
