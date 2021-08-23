<?php

namespace Accentinteractive\LaravelDisallowlister\Tests;

use Artisan;
use Config;
use Accentinteractive\LaravelDisallowlister\Facades\Disallowlister;

/**
 * Class LogCleanerTest
 */
class LaravelDisallowlisterTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_has_an_alias()
    {
        $this->assertEquals([], DisallowLister::getDisallowList());
    }

    /** @test */
    public function it_can_perform_disallowlister_tests ()
    {
        config(['disallowlister.disallowed_strings' => ['*foo*']]);

        $this->assertTrue(Disallowlister::isDisallowed('foo'));
        $this->assertTrue(Disallowlister::isDisallowed('footer'));
        $this->assertTrue(Disallowlister::isDisallowed('barefoot'));
        $this->assertFalse(Disallowlister::isDisallowed('bar'));
    }


}
