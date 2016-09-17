<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;

class ProfileTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * Set up tests
     */
    public function setUp()
    {
        parent::setUp();
        App::setLocale('en');
    }

    /**
     * Test settings route is installed.
     *
     * @return void
     */
    public function testSettingsRouteIsInstalled()
    {
        $user = factory(App\User::class)->create();

        $this->actingAs($user)
             ->visitRoute('profile')->assertResponseOk()
             ->see('Settings');
    }

    /**
     * Test settings route is only visitable by authenticated users.
     *
     * @return void
     */
    public function testSettingsRouteIsOnlyVisitableByAuthenticatedUsers()
    {
        $this->visitRoute('profile')->see('login');
    }
}
