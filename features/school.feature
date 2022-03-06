Feature: School
        In order to see the schools list
        And the school details

    Scenario: Get the schools list
        Given I am authenticated with the role "SUPERADMIN"
        When I visit the page "/schools"
        Then I should see the schools list