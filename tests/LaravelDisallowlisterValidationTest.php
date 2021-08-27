<?php

namespace Accentinteractive\LaravelDisallowlister\Tests;

use Artisan;
use Config;
use Accentinteractive\LaravelDisallowlister\Facades\Disallowlister;

/**
 * Class LogCleanerTest
 */
class LaravelDisallowlisterValidationTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    function string_in_disallowlist_fails()
    {
        config(['disallowlister.disallowed_strings' => ['*foo*']]);

        $rules = ['field1' => 'disallowlister'];
        $data = ['field1' => 'barefoot',];

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());
    }

    /** @test */
    function string_not_in_disallowlist_passes()
    {
        config(['disallowlister.disallowed_strings' => ['*foo*']]);

        $rules = ['field1' => 'disallowlister'];
        $data = ['field1' => 'fo',];

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }
}
