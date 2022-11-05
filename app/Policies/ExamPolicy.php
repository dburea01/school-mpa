<?php
namespace App\Policies;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExamPolicy
{
    use HandlesAuthorization;

    protected $exam;

    public function __construct()
    {
        $this->exam = request()->route()->parameter('exam');
    }

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    public function viewAny(User $user)
    {
        return ($user->isDirector() || $user->isTeacher());
    }

    public function create(User $user)
    {
        return ($user->isDirector() || $user->isTeacher());
    }

    public function update(User $user)
    {
        return $this->create($user);
    }

    public function delete(User $user)
    {
        return $this->create($user);
    }
}
