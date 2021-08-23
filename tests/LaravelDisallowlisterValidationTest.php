<?php

namespace Accentinteractive\LaravelDisallowlister\Tests;

use Accentinteractive\LaravelDisallowlister\Rules\Disallowlist;
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

        $rule = new Disallowlist();

        $this->assertFalse($rule->passes('some_attribute', 'foo'));
        $this->assertFalse($rule->passes('some_attribute', 'footer'));
        $this->assertFalse($rule->passes('some_attribute', 'barefoot'));
    }

    /** @test */
    function string_not_in_disallowlist_passes()
    {
        config(['disallowlister.disallowed_strings' => ['*foo*']]);

        $rule = new Disallowlist();

        $this->assertTrue($rule->passes('some_attribute', 'bar'));
    }
}
