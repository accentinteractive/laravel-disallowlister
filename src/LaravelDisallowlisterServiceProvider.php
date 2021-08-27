<?php

namespace Accentinteractive\LaravelDisallowlister;

use Accentinteractive\LaravelDisallowlister\Facades\Disallowlister;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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

        $this->createDisallowListValidation();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/disallowlister.php' => config_path('disallowlister.php'),
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
        $this->mergeConfigFrom(__DIR__ . '/../config/disallowlister.php', 'disallowlister');

        $this->app->singleton('Disallowlister', function () {
            return (new LaravelDisallowlister(config('disallowlister.lists.default')))
                ->caseSensitive(config('disallowlister.is_case_sensitive'))
                ->setWordForWord(config('disallowlister.match_word_for_word'));
        });
    }

    protected function createDisallowListValidation(): void
    {
        Validator::extend('disallowlister', function ($attribute, $value, $parameters) {
            $listName = ! empty($parameters[0]) ? $parameters[0] : LaravelDisallowlister::DEFAULT_LIST;
            $defaultdisallowedStrings = config('disallowlister.lists.' . LaravelDisallowlister::DEFAULT_LIST);
            $disallowedStrings = config('disallowlister.lists.' . $listName, $defaultdisallowedStrings);

            return Disallowlister::setDisallowList($disallowedStrings)
                                 ->isDisallowed($value) == false;
        });
    }
}
