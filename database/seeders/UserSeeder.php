<?php
namespace Database\Seeders;

use App\Models\Group;
use App\Models\School;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserGroup;

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
            User::factory()->count(2)->create([
                'school_id' => $school->id,
                'role_id' => 'DIRECTOR',
                'status' => 'ACTIVE'
            ]);

            User::factory()->count(10)->create([
                'school_id' => $school->id,
                'role_id' => 'TEACHER',
            ]);

            // for each groups, create 2 parents + some students and associate them
            $groups = Group::where('school_id', $school->id)->get();

            foreach ($groups as $group) {
                $parents = User::factory()->count(2)->create([
                    'school_id' => $school->id,
                    'role_id' => 'PARENT',
                    'last_name' => $group->name
                ]);

                $this->createUserGroup($group, $parents);

                $students = User::factory()->count(random_int(1, 3))->create([
                    'school_id' => $school->id,
                    'role_id' => 'STUDENT',
                    'last_name' => $group->name
                ]);

                $this->createUserGroup($group, $students);
            }

            // qty of max users of the school, regarding the quantity of users just inserted in the DB
            $qtyUsers = User::where('school_id', $school->id)->count();
            $school->max_users = round($qtyUsers * (1 + random_int(10, 40) / 100));
            $school->save();
        }
    }

    public function createUserGroup(Group $group, $users)
    {
        foreach ($users as $user) {
            UserGroup::factory()->create([
                'group_id' => $group->id,
                'user_id' => $user->id
            ]);
        }
    }
}
