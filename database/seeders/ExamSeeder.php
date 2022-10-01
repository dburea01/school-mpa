<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamStatus;
use App\Models\ExamType;
use App\Models\School;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schools = School::all();
        $ExamStatus = ExamStatus::all();

        foreach ($schools as $school) {
            $classrooms = Classroom::where('school_id', $school->id)->get();
            $subjects = Subject::where('school_id', $school->id)->get();
            $examTypes = ExamType::where('school_id', $school->id)->get();

            for ($i = 0; $i < 100; $i++) {
                Exam::factory()->create([
                    'school_id' => $school->id,
                    'exam_type_id' => $examTypes->random()->id,
                    'subject_id' => $subjects->random()->id,
                    'classroom_id' => $classrooms->random()->id,
                    'exam_status_id' => $ExamStatus->random()->id,
                ]);
            }
        }
    }
}
