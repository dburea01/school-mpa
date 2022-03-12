<?php

namespace Database\Seeders;

use App\Models\Period;
use App\Models\School;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
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
            Period::factory()->count(2)->create([
                'school_id' => $school->id
            ]);
        }
    }
}
