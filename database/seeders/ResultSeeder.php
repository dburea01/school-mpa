<?php
namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Exam;
use App\Models\Result;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exams = Exam::whereIn('exam_status_id', [50, 60])->get();

        foreach ($exams as $exam) {
            // find the students of this exam
            $students = DB::table('users')
            ->join('assignments', 'users.id', 'assignments.user_id')
            ->where('users.school_id', $exam->school_id)
            ->where('users.role_id', 'STUDENT')
            ->where('assignments.classroom_id', $exam->classroom->id)
            ->select('users.id')
            ->get();

            // all the results are made
            if ($exam->exam_status_id === 60) {
                foreach ($students as $student) {
                    Result::Factory()->create([
                        'school_id' => $exam->school_id,
                        'exam_id' => $exam->id,
                        'user_id' => $student->id
                    ]);
                }
            }

            // all the results are NOT made
            if ($exam->exam_status_id === 50) {
                $qtyStudents = $students->count();
                for ($i = 0; $i < $qtyStudents / 2 ; $i++) {
                    Result::Factory()->create([
                        'school_id' => $exam->school_id,
                        'exam_id' => $exam->id,
                        'user_id' => $students[$i]->id
                    ]);
                }
            }
        }
    }
}
