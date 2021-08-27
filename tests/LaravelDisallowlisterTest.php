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
        config(['disallowlister.lists.default' => ['*foo*']]);

        $this->assertTrue(Disallowlister::isDisallowed('foo'));
        $this->assertTrue(Disallowlister::isDisallowed('footer'));
        $this->assertTrue(Disallowlister::isDisallowed('barefoot'));
        $this->assertFalse(Disallowlister::isDisallowed('bar'));
    }

    /** @test */
    public function it_can_specify_a_named_disallowList ()
    {
        config(['disallowlister.lists.default' => ['*foo*']]);
        config(['disallowlister.lists.mylist' => ['*bar*']]);

        $disallowlister = DisallowLister::setDisallowList(config('disallowlister.lists.mylist'));
        $this->assertTrue($disallowlister->isDisallowed('bars'));
        $this->assertFalse($disallowlister->isDisallowed('footer'));
    }

}
