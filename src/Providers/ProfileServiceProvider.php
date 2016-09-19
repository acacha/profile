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

        $this->mergeConfigFrom(
            ACACHA_PROFILE_PATH.'/config/profile.php', 'acacha-profile'
        );
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
        $this->publishPublicAssets();
        $this->publishViews();
        $this->publishResourceAssets();
        $this->publishLanguages();
        $this->loadMigrations();
        $this->publishConfigFile();
    }

    /**
     * Define the Profile package routes.
     */
    protected function defineRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => 'Acacha\Profile\Http\Controllers'], function () {
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

    /**
     * Publish public resource assets to Laravel project.
     */
    private function publishPublicAssets()
    {
        $this->publishes(Profile::publicAssets(), 'acacha-profile');
    }

    /**
     * Publish package views to Laravel project.
     */
    private function publishViews()
    {
        $this->loadViewsFrom(ACACHA_PROFILE_PATH.'/resources/views/', 'acacha-profile');

        $this->publishes(Profile::views(), 'acacha-profile');
    }

    /**
     * Publish package resource assets to Laravel project.
     */
    private function publishResourceAssets()
    {
        $this->publishes(Profile::resourceAssets(), 'acacha-profile');
    }

    /**
     * Publish package language to Laravel project.
     */
    private function publishLanguages()
    {
        $this->loadTranslationsFrom(ACACHA_PROFILE_PATH.'/resources/lang/', 'acacha-profile_lang');

        $this->publishes([
            ACACHA_PROFILE_PATH.'/resources/lang/' => resource_path('lang/vendor/acacha-profile_lang'),
        ]);
    }

    /**
     * Publish package language to Laravel project.
     */
    private function loadMigrations()
    {
        $this->loadMigrationsFrom(ACACHA_PROFILE_PATH.'/migrations');
    }

    /**
     * Publish config file to Laravel project.
     */
    private function publishConfigFile()
    {
        $this->publishes([
            ACACHA_PROFILE_PATH.'/config/courier.php' => config_path('profile.php'),
        ]);
    }

}