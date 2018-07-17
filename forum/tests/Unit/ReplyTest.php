<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class ReplyTest extends TestCase
{
    use DatabaseMigrations; //because we use sqlite in memory

    /** @test */
    function it_has_an_owner()
    {
        $reply = factory('App\Reply')->create();
        $this->assertInstanceOf('App\User',$reply->owner);
    }
}
