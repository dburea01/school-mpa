<?php
namespace Database\Seeders;

use App\Models\AssignmentTeacher;
use App\Models\Classroom;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignmentTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::where('role_id', 'TEACHER')->get();
        $classrooms = Classroom::all();
        $subjects = Subject::all();

        foreach ($teachers as $teacher) {
            $assignedClassrooms = $classrooms->random(rand(1, 2));

            foreach ($assignedClassrooms as $assignedClassroom) {
                $subjectAssigned = $subjects->random();

                AssignmentTeacher::factory()->create([
                    'user_id' => $teacher->id,
                    'classroom_id' => $assignedClassroom->id,
                    'subject_id' => $subjectAssigned->id,
                ]);
            }
        }
    }
}
