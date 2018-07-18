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

        $this->post('/threads/1/replies',[]);
    }

    /** @test */
    function an_authenticated_user_may_participate_in_form_threads()
    {


        $this->signIn($user = factory('App\User')->create());//to make the user authenticated


        $thread = create('App\Thread');


        $reply = make('App\Reply');
        $this->post($thread->path().'/replies',$reply->toArray());



        $this->get($thread->path())
            ->assertSee($reply->body);
    }


}
