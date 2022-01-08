<?php

namespace Database\Seeders;

use App\Models\Group;
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
            'status' => 'ACTIVE'
        ]);

        // for each school, create 1 director + some teachers
        $schools = School::all();

        foreach ($schools as $school) {
            User::factory()->count(10)->create([
                'school_id' => $school->id,
                'role_id' => 'DIRECTOR',
                'status' => 'ACTIVE'
            ]);

            User::factory()->count(30)->create([
                'school_id' => $school->id,
                'role_id' => 'TEACHER',
            ]);

            // for each groups, create 2 parents + some students
            $groups = Group::where('school_id', $school->id)->get();

            foreach ($groups as $group) {
                User::factory()->count(2)->create([
                    'school_id' => $school->id,
                    'role_id' => 'PARENT',
                    'group_id' => $group->id,
                    'last_name' => $group->name
                ]);

                User::factory()->count(random_int(1, 3))->create([
                    'school_id' => $school->id,
                    'role_id' => 'STUDENT',
                    'group_id' => $group->id,
                    'last_name' => $group->name
                ]);
            }
        }
    }
}
