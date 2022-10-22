<?php
namespace Database\Seeders;

use App\Models\School;
use App\Repositories\SchoolRepository;
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

        $schoolRepository = new SchoolRepository();

        foreach ($schools as $school) {
            $schoolRepository->initSubjects($school);
        }
    }
}
