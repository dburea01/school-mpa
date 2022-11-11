<?php
namespace App\Repositories;

use App\Models\Subject;
use App\Models\User;
use App\Models\UserSubject;

class UserSubjectRepository
{
    public function all()
    {
        return UserSubject::with(['user', 'subject'])->get();
    }

    public function getSubjects(User $user)
    {
        return UserSubject::where('user_id', $user->id)->get();
    }

    public function destroyAllSubjects(User $user): void
    {
        UserSubject::where('user_id', $user->id)->delete();
    }

    public function insert(User $user, int $subjectId): UserSubject
    {
        return UserSubject::create([
            'user_id' => $user->id,
            'subject_id' => $subjectId
        ]);
    }
}
