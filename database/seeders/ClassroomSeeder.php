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
        $periods = Period::all();

        foreach ($periods as $period) {
            try {
                Classroom::factory()->count(random_int(5, 10))->create([
                    'period_id' => $period->id,
                ]);
            } catch (\Throwable $th) {
                echo $th->getMessage();
                echo "error creating classroom, let's go on !";
            }
        }
    }
}
