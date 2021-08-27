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
        config(['disallowlister.lists.default' => ['*foo*']]);

        $rules = ['field1' => 'disallowlister'];
        $data = ['field1' => 'barefoot',];

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());
    }

    /** @test */
    function string_not_in_disallowlist_passes()
    {
        config(['disallowlister.lists.default' => ['*foo*']]);

        $rules = ['field1' => 'disallowlister'];
        $data = ['field1' => 'bar',];

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertTrue($validator->passes());
    }

    /** @test */
    function it_can_take_a_specific_validation_list()
    {
        config(['disallowlister.lists.mylist' => ['*foo*']]);

        $rules = ['field1' => 'disallowlister:mylist'];
        $data = ['field1' => 'foo',];

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());
    }

    /** @test */
    function it_uses_default_list_as_fallback()
    {
        config(['disallowlister.lists.default' => ['*foo*']]);
        config(['disallowlister.lists.mylist' => ['*bar*']]);

        $rules = ['field1' => 'disallowlister:nonexistinglist'];
        $data = ['field1' => 'foo',];

        $validator = $this->app['validator']->make($data, $rules);
        $this->assertFalse($validator->passes());
    }
}
