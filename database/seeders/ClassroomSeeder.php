<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Period;
use App\Models\School;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schools = School::all();

        foreach ($schools as $school) {
            $this->createClassrooms($school);
        }
    }

    private function createClassrooms(School $school)
    {
        $periods = Period::where('school_id', $school->id)->get();

        foreach ($periods as $period) {
            try {
                Classroom::factory()->count(random_int(2, 5))->create([
                    'school_id' => $school->id,
                    'period_id' => $period->id,
                ]);
            } catch (\Throwable $th) {
                echo $th->getMessage();
                echo "error creating classroom, let's go on !";
            }
        }
    }
}
