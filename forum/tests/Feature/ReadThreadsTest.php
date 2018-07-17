<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;
//    private $thread;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->thread = factory('App\Thread')->create();

    }



    /** @test */
    public function a_user_can_browse_threads()
    {
        //test1 : response of the serve is 200 ok
        $this->get('/threads')
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        //test2 : if i make thread i can see the title of that thread
        $this->get('/threads')
            ->assertSee($this->thread->title);


    }


    /** @test */
    public function a_user_can_read_a_single_threads()
    {
        //test3 : user can show one thread
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // Given we have a thread
        // And that thread includes replies
        $reply = factory('App\Reply')
            ->create(['thread_id'=>$this->thread->id]);
        // When we visit a thread page
        // Then we should see the replies
        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

}
