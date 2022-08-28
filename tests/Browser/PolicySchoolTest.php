<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PolicySchoolTest extends DuskTestCase
{
    use DatabaseMigrations;
    use Tools;

    public function test_a_superadmin_can_see_the_schools_list()
    {
        $this->browse(function (Browser $browser) {
            $superAdmin = $this->createSchoolAndUserWithRole('SUPERADMIN');
            $browser->loginAs($superAdmin)
                ->visit('/schools')
                ->screenshot('essai')
                ->assertSee('Schools list');
        });
    }

    public function test_a_director_cannot_see_the_schools_list()
    {
        $this->browse(function (Browser $browser) {
            $director = $this->createSchoolAndUserWithRole('DIRECTOR');
            $browser->loginAs($director)
                ->visit('/schools')
                ->screenshot('essai')
                ->assertSee('FORBIDDEN');
        });
    }
}
