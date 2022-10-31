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
        Period::factory()->create([
            'name' => 'Année scolaire 2021-2022',
            'start_date' => '2021-09-01',
            'end_date' => '2022-06-30',
            'current' => true
        ]);

        Period::factory()->create([
            'name' => 'Année scolaire 2022-2023',
            'start_date' => '2022-09-01',
            'end_date' => '2023-06-30',
            'current' => false
        ]);
    }
}
