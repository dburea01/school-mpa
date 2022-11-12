<?php
namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\AssignmentStudent;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class AssignmentStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classrooms = Classroom::all();

        foreach ($classrooms as $classroom) {
            // get some students of this classrooms
            $students = User::where('role_id', 'STUDENT')
            ->limit(random_int(1, 10))
            ->get();

            $this->insertAssignmentStudents($classroom, $students);
        }
    }

    public function insertAssignmentStudents(Classroom $classroom, Collection $users)
    {
        foreach ($users as $user) {
            AssignmentStudent::factory()->create([
                'classroom_id' => $classroom->id,
                'user_id' => $user->id,
                'comment' => $user->full_name . " ($user->role_id)",
            ]);
        }
    }
}
