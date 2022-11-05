<?php
namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubjectPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return $user->isDirector();
    }

    public function view(User $user, Subject $subject)
    {
        return $user->isDirector();
    }

    public function create(User $user)
    {
        return $user->isDirector();
    }

    public function update(User $user, Subject $subject)
    {
        return $user->isDirector();
    }

    public function delete(User $user, Subject $subject)
    {
        return $user->isDirector();
    }
}
