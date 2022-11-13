<?php
namespace Database\Seeders;

use App\Models\AssignmentTeacher;
use App\Models\School;
use App\Models\UserSubject;
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
            AssignmentStudentSeeder::class,
            AssignmentTeacherSeeder::class,
            ExamSeeder::class,
            ResultSeeder::class,
        ]);
    }
}
