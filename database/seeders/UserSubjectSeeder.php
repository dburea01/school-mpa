<?php
namespace Database\Seeders;

use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use App\Models\UserSubject;
use Illuminate\Database\Seeder;

class UserSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::where('role_id', 'TEACHER')->get();
        $subjects = Subject::all();

        foreach ($subjects as $subject) {
            $someTeachers = $teachers->random(rand(1, 2));
            foreach ($someTeachers as $teacher) {
                UserSubject::create([
                    'user_id' => $teacher->id,
                    'subject_id' => $subject->id
                ]);
            }
        }
    }
}
