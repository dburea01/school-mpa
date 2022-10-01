<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        School::factory(5)->create();

        $this->call([
            GroupSeeder::class,
            UserSeeder::class,
            SubjectSeeder::class,
            PeriodSeeder::class,
            ClassroomSeeder::class,
            AssignmentSeeder::class,
            ExamTypeSeeder::class,
            ExamSeeder::class,
        ]);
    }
}
