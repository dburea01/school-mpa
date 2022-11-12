<?php
namespace App\Repositories;

use App\Models\AssignmentTeacher;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\User;

class AssignmentTeacherRepository
{
    public function index(array $request)
    {
        $query = AssignmentTeacher::with(['user', 'classroom', 'subject']);

        if (array_key_exists('user_id', $request) && $request['user_id'] !== null) {
            $query->where('user_id', $request['user_id']);
        }

        if (array_key_exists('classroom_id', $request) && $request['classroom_id'] !== null) {
            $query->where('classroom_id', $request['classroom_id']);
        }

        if (array_key_exists('subject_id', $request) && $request['subject_id'] !== null) {
            $query->where('subject_id', $request['subject_id']);
        }

        return $query->paginate();
    }

    public function destroy(AssignmentTeacher $assignmentTeacher): void
    {
        $assignmentTeacher->delete();
    }

    public function insert(int $classroomId, int $subjectId, string $userId, string $comment = null): AssignmentTeacher
    {
        return AssignmentTeacher::create([
            'classroom_id' => $classroomId,
            'subject_id' => $subjectId,
            'user_id' => $userId,
            'comment' => $comment
        ]);
    }

    public function update(AssignmentTeacher $assignmentTeacher, array $data) :AssignmentTeacher
    {
        $assignmentTeacher->user_id = $data['user_id'];
        $assignmentTeacher->classroom_id = $data['classroom_id'];
        $assignmentTeacher->subject_id = $data['subject_id'];
        $assignmentTeacher->comment = $data['comment'];
        $assignmentTeacher->save();

        return $assignmentTeacher;
    }
}
