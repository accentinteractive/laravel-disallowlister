<?php

namespace Accentinteractive\LaravelDisallowlister;

use Accentinteractive\LaravelDisallowlister\Facades\Disallowlister;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\Validator;

class LaravelDisallowlisterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-disallowlister');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-disallowlister');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/disallowlister.php' => config_path('disallowlister.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-disallowlister'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-disallowlister'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-disallowlister'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/disallowlister.php', 'disallowlister');

        $this->app->singleton('Disallowlister', function () {
            return (new LaravelDisallowlister(config('disallowlister.disallowed_strings')));
        });
    }
}
