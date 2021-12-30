<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'school_id' => null,
            'role_id' => 'SUPERADMIN',
        ]);

        $schools = School::all();

        foreach ($schools as $school) {
            User::factory()->create([
                'school_id' => $school->id,
                'role_id' => 'DIRECTOR',
                'status' => 'ACTIVE'
            ]);

            User::factory()->count(random_int(1, 50))->create([
                'school_id' => $school->id,
                'role_id' => 'STUDENT'
            ]);

            User::factory()->count(random_int(1, 20))->create([
                'school_id' => $school->id,
                'role_id' => 'PARENT'
            ]);

            User::factory()->count(10)->create([
                'school_id' => $school->id,
                'role_id' => 'TEACHER',
            ]);
        }
    }
}
