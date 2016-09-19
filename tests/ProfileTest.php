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

    /*
     * Overwrite createApplication to add Http Kernel
     * see: https://github.com/laravel/laravel/pull/3943
     *      https://github.com/laravel/framework/issues/15426
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Http\Kernel::class);

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
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
