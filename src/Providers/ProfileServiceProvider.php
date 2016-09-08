<?php

namespace Acacha\Profile\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\AppNamespaceDetectorTrait;

use Acacha\Profile\Facades\Profile;

/**
 * Class ProfileServiceProvider.
 */
class ProfileServiceProvider extends ServiceProvider
{
    use AppNamespaceDetectorTrait;

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the application services.
     */
    public function register()
    {
        if (!defined('ACACHA_PROFILE_PATH')) {
            define('ACACHA_PROFILE_PATH', realpath(__DIR__.'/../../'));
        }

        $this->app->bind('Profile', function () {
            return new \Acacha\Profile\Profile();
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->defineRoutes();
        $this->publishTests();
    }

    /**
     * Define the Profile package routes.
     */
    protected function defineRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => $this->getAppNamespace().'Http\Controllers'], function () {
                require __DIR__.'/../routes/web.php';
            });
        }
    }

    /**
     * Publish package tests to Laravel project.
     */
    private function publishTests()
    {
        $this->publishes(Profile::tests(), 'acacha-profile');
    }

}