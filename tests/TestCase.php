<?php

namespace Accentinteractive\LaravelDisallowlister\Tests;

use Accentinteractive\LaravelDisallowlister\LaravelDisallowlister;
use Accentinteractive\LaravelDisallowlister\LaravelDisallowlisterServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelDisallowlisterServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Disallowlister' => LaravelDisallowlister::class,
        ];
    }
}
