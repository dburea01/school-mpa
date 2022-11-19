<?php
namespace Database\Seeders;

use App\Models\Group;
use App\Models\School;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create an administrator
        User::factory()->create([
            'role_id' => 'ADMIN',
            'status' => 'ACTIVE'
        ]);

        // create a director
        User::factory()->create([
            'role_id' => 'DIRECTOR',
            'status' => 'ACTIVE',
        ]);

        // create some teachers
        User::factory()->count(20)->create([
            'role_id' => 'TEACHER',
        ]);

        // for each groups, create 2 parents + some students and associate them
        $groups = Group::all();

        foreach ($groups as $group) {
            $parents = User::factory()->count(2)->create([
                'role_id' => 'PARENT',
                'last_name' => $group->name,
            ]);

            $this->createUserGroup($group, $parents);

            $students = User::factory()->count(random_int(1, 3))->create([
                'role_id' => 'STUDENT',
                'last_name' => $group->name,
            ]);

            $this->createUserGroup($group, $students);
        }
    }

    public function createUserGroup(Group $group, $users)
    {
        foreach ($users as $user) {
            UserGroup::factory()->create([
                'group_id' => $group->id,
                'user_id' => $user->id,
            ]);
        }
    }
}
