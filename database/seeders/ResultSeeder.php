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
            ->join('assignment_students', 'users.id', 'assignment_students.user_id')
            ->where('users.role_id', 'STUDENT')
            ->where('assignment_students.classroom_id', $exam->classroom->id)
            ->select('users.id')
            ->get();

            // for the exams in status 60 (totally corrected)
            if ($exam->exam_status_id === 60) {
                foreach ($students as $student) {
                    Result::Factory()->create([
                        'exam_id' => $exam->id,
                        'user_id' => $student->id
                    ]);
                }
            }

            // for the exams in status 50 (not totally corrected)
            if ($exam->exam_status_id === 50) {
                $qtyStudents = $students->count();
                for ($i = 0; $i < $qtyStudents / 2 ; $i++) {
                    Result::Factory()->create([
                        'exam_id' => $exam->id,
                        'user_id' => $students[$i]->id
                    ]);
                }
            }
        }
    }
}
