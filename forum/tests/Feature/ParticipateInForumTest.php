<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class ParticipateInForumTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function unauthenticated_users_may_not_add_replies()
    {

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create();
        $this->post($thread->path().'/replies',$reply->toArray());
    }

    /** @test */
    function an_authenticated_user_may_participate_in_form_threads()
    {

        // Given we have an authenticated user
        $user = factory('App\User')->create();
        $this->signIn($user);//to make the user authenticated

        // And an existing thread
        $thread = factory('App\Thread')->create();

        // when the user adds a reply to the thread
        $reply = factory('App\Reply')->create();
        $this->post($thread->path().'/replies',$reply->toArray());


        // Then their reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);
    }


}
