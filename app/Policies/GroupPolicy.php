<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    protected $group;

    public function __construct()
    {
        $this->group = request()->route()->parameter('group');
    }

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

    public function create(User $user)
    {
        return $user->isDirector();
    }

    public function update(User $user)
    {
        return $user->isDirector();
    }

    public function delete(User $user)
    {
        return $user->isDirector();
    }
}
