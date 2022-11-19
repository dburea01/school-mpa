<?php
namespace App\Repositories;

use App\Models\Exam;
use App\Models\Result;
use Illuminate\Support\Facades\DB;

class ResultRepository
{
    public function index(Exam $exam)
    {
        $students = DB::table('users')
        ->join('assignment_students', 'users.id', 'assignment_students.user_id')
        ->where('users.role_id', 'STUDENT')
        ->where('assignment_students.classroom_id', $exam->classroom->id)
        ->orderBy('users.last_name')
        ->select('users.last_name', 'users.first_name', 'users.id')
        ->get();

        foreach ($students as $student) {
            $student->result = Result::where('exam_id', $exam->id)
            ->where('user_id', $student->id)
            ->with('appreciation')
            ->first();
        }
        // dd($students);
        return $students;
    }

    public function insert(Exam $exam, array $data): Result
    {
        $result = new Result();
        $result->fill($data);
        $result->exam_id = $exam->id;
        $result->save();

        return $result;
    }

    public function delete(Exam $exam, string $userId): void
    {
        Result::where('exam_id', $exam->id)
        ->where('user_id', $userId)
        ->delete();
    }

    public function getAverageExam(Exam $exam): ?float
    {
        return Result::where('exam_id', $exam->id)
        ->whereNotNull('note_num')
        ->avg('note_num');
    }

    public function getMinExam(Exam $exam): ?float
    {
        return Result::where('exam_id', $exam->id)
        ->whereNotNull('note_num')
        ->min('note_num');
    }

    public function getMaxExam(Exam $exam): ?float
    {
        return Result::where('exam_id', $exam->id)
        ->whereNotNull('note_num')
        ->max('note_num');
    }

    public function getQtyNotesExam(Exam $exam): ?float
    {
        return Result::where('exam_id', $exam->id)
        ->whereNotNull('note_num')
        ->count('note_num');
    }

    public function getReportExam(Exam $exam): array
    {
        return [
            'avg' => round($this->getAverageExam($exam), 2),
            'min' => $this->getMinExam($exam),
            'max' => $this->getMaxExam($exam),
            'qtyNotes' => $this->getQtyNotesExam($exam),
        ];
    }
}
