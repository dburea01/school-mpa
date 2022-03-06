<?php

// features/bootstrap/FeatureContext.php

use Behat\Behat\Context\Context;
use App\Models\School;
use App\Models\User;
use Behat\Behat\Tester\Exception\PendingException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Behat\Hook\Scope\AfterScenarioScope;

class SchoolContext extends TestCase implements Context
{
    use DatabaseMigrations;

    /**
     * @Given I am authenticated with the role :arg1
     */
    public function iAmAuthenticatedWithTheRole(string $roleId)
    {
        $school = School::factory()->create();
        $user = User::factory()->create(['school_id' => $school->id, 'role_id' => $roleId]);
        $this->be($user);
    }


    /**
     * @When I visit the page :arg1
     */
    public function iVisitThePage($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I should see the schools list
     */
    public function iShouldSeeTheSchoolsList()
    {
        throw new PendingException();
    }
}
