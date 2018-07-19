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
        $thread = make('App\Thread');//make because we just need the data generated not to store it directory

        $response = $this->post('/threads',$thread->toArray());


        // Then, when we visit the thread page
        // we should see the new thread
        $this->get($response->headers->get('location'))->assertSee($thread->title)
             ->assertSee($thread->body);
    }


    /** @test */
    function a_thread_requires_a_title()
    {
        $this->publishThread(['title'=>null])
            ->assertSessionHasErrors('title');
    }


    /** @test */
    function a_thread_requires_a_body()
    {
        $this->publishThread(['body'=>null])
            ->assertSessionHasErrors('body');

    }

    /** @test */
    function a_thread_requires_a_valid_channel()
    {

        //to test the failure if the channel exist in memory which is testing database configured
        factory('App\Channel',2)->create();//give channel_id = 1 or 2


        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');


        $this->publishThread(['channel_id' => 99999999])
            ->assertSessionHasErrors('channel_id');
    }

    public function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread',$overrides);

        return $this->post('/threads',$thread->toArray());
    }



}
