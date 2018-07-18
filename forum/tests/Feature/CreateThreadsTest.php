<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;


    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed in user
        $this->actingAs(factory('App\User')->create());

        // When we hit the endpoint to create a new thread
        $thread=factory('App\Thread')->make();//make because we just need the data generated not to store it directory
        $this->post('/threads',$thread->toArray());


        // Then, when we visit the thread page
        $response=$this->get($thread->path());



        // we should see the new thread
        $response->assertSee($thread->title)
             ->assertSee($thread->body);
    }

}
