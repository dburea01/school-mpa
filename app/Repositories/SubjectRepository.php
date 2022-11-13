<?php
namespace App\Repositories;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SubjectRepository
{
    public function all()
    {
        return Subject::orderBy('short_name')->get();
    }

    public function getAuthorizedSubjects(User $user)
    {
        $query = DB::table('subjects')->select('subjects.*');

        // A teacher can see only the subjects in which he is assigned.
        if ($user->isTeacher()) {
            $query->join('assignment_teachers', function ($join) use ($user) {
                $join->on('assignment_teachers.subject_id', 'subjects.id')
                ->where('assignment_teachers.user_id', $user->id);
            });
        }

        return $query->get();
    }

    public function update(Subject $subject, array $data): Subject
    {
        $subject->fill($data);

        $subject->name = [
            'fr' => $data['name_fr'],
            'en' => $data['name_en']
        ];
        $subject->save();

        return $subject;
    }

    public function destroy(Subject $subject): void
    {
        $subject->delete();
    }

    public function insert(array $data): Subject
    {
        $subject = new Subject();
        $subject->fill($data);
        $subject->name = [
            'fr' => $data['name_fr'],
            'en' => $data['name_en']
        ];
        $subject->save();

        return $subject;
    }
}
