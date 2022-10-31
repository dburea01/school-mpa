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
        School::factory(1)->create();

        $this->call([
            GroupSeeder::class,
            UserSeeder::class,
            PeriodSeeder::class,
            ClassroomSeeder::class,
            AssignmentSeeder::class,

            ExamSeeder::class,
            ResultSeeder::class,
        ]);
    }
}
