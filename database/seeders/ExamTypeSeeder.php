<?php
namespace Database\Seeders;

use App\Models\ExamType;
use App\Models\Period;
use App\Models\School;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
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
            $examTypes = [
                [
                    'school_id' => $school->id,
                    'position' => 10,
                    'short_name' => ['en' => 'USW', 'fr' => 'DNS'],
                    'name' => ['en' => 'Unsupervised work', 'fr' => 'Devoir non surveillé'],

                ],
                [
                    'school_id' => $school->id,
                    'position' => 20,
                    'short_name' => ['en' => 'SD', 'fr' => 'DS'],
                    'name' => ['en' => 'Supervised work', 'fr' => 'Devoir surveillé'],

                ],
                [
                    'school_id' => $school->id,
                    'position' => 30,
                    'short_name' => ['en' => 'OW', 'fr' => 'OR'],
                    'name' => ['en' => 'Oral Work', 'fr' => 'Oral'],

                ]
            ];

            foreach ($examTypes as $examType) {
                ExamType::create($examType);
            }
        }
    }
}
