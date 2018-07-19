<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;


class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;



    /** @test */
    function guests_may_not_create_threads()
    {
        $this->withExceptionHandling();

        // create thread page
        $this->get('/threads/create')
            ->assertRedirect('/login');

        // store thread data
        $this->post('/threads')
            ->assertRedirect('/login');
    }


    /** @test */
    function an_authenticated_user_can_create_new_forum_threads()
    {
        // Given we have a signed in user
        $this->signIn();

        // When we hit the endpoint to create a new thread
        $thread=create('App\Thread');//make because we just need the data generated not to store it directory
        $this->post('/threads',$thread->toArray());




        // Then, when we visit the thread page
        // we should see the new thread
        $this->get($thread->path())->assertSee($thread->title)
             ->assertSee($thread->body);
    }



}
