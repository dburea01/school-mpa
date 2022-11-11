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
            'start_date' => '01/09/2021',
            'end_date' => '30/06/2022',
            'current' => true
        ]);

        Period::factory()->create([
            'name' => 'Année scolaire 2022-2023',
            'start_date' => '01/09/2022',
            'end_date' => '30/06/2023',
            'current' => false
        ]);
    }
}
