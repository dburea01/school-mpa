<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
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
            try {
                Subject::factory()->count(random_int(5, 10))->create([
                    'school_id' => $school->id,
                ]);
            } catch (\Throwable $th) {
                echo $th->getMessage();
                echo 'on continue ....';
            }
        }
    }
}
