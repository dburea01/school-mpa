<?php

namespace tests\Browser;

use App\Models\School;
use App\Models\User;

trait Tools
{


    public function createSchoolAndUserWithRole(string $roleId): User
    {
        $school = School::factory()->create();
        return User::factory()->create([
            'school_id' => $school->id,
            'role_id' => $roleId,
        ]);
    }
}
