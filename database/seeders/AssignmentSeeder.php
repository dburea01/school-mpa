<?php
namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
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
            // get some students + teachers  of the school of this classrooms
            $students = User::where('school_id', $classroom->school_id)
            ->where('role_id', 'STUDENT')
            ->limit(random_int(1, 10))
            ->get();

            $this->insertAssignments($classroom, $students);

            $teachers = User::where('school_id', $classroom->school_id)
            ->where('role_id', 'TEACHER')
            ->limit(random_int(1, 2))
            ->get();

            $this->insertAssignments($classroom, $teachers);
        }
    }

    public function insertAssignments(Classroom $classroom, Collection $users)
    {
        foreach ($users as $user) {
            Assignment::factory()->create([
                'school_id' => $classroom->school_id,
                'classroom_id' => $classroom->id,
                'user_id' => $user->id,
                'comment' => $user->full_name . " ($user->role_id)"
            ]);
        }
    }
}
