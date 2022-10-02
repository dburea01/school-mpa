<?php
namespace App\Repositories;

use App\Models\Exam;
use App\Models\Result;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ResultRepository
{
    public function index(School $school, Exam $exam)
    {
        $students = DB::table('users')
        ->join('assignments', 'users.id', 'assignments.user_id')
        ->where('users.school_id', $school->id)
        ->where('users.role_id', 'STUDENT')
        ->where('assignments.classroom_id', $exam->classroom->id)
        ->orderBy('users.last_name')
        ->select('users.last_name', 'users.first_name', 'users.id')
        ->get();

        foreach ($students as $student) {
            $student->result = Result::where('school_id', $school->id)
            ->where('exam_id', $exam->id)
            ->where('user_id', $student->id)
            ->first();
        }
        return $students;
    }

    public function insert(School $school, Exam $exam, array $data): Result
    {
        $result = new Result();
        $result->fill($data);
        $result->school_id = $school->id;
        $result->exam_id = $exam->id;
        $result->save();

        return $result;
    }

    public function delete(School $school, Exam $exam, string $userId): void
    {
        Result::where('school_id', $school->id)
        ->where('exam_id', $exam->id)
        ->where('user_id', $userId)
        ->delete();
    }
}
