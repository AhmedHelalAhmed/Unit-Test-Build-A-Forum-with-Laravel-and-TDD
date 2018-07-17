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
        $response = $this->get('/threads');
        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        //test2 : if i make thread i can see the title of that thread
        //$thread = factory('App\Thread')->create();
        $response = $this->get('/threads');
        //$response->assertSee($thread->title);
        $response->assertSee($this->thread->title);


    }


    /** @test */
    public function a_user_can_read_a_single_threads()
    {
        //test3 : user can show one thread
//        $thread = factory('App\Thread')->create();
//        $response = $this->get('/threads/' . $thread->id);
//        $response->assertSee($thread->title);

        $response = $this->get('/threads/' . $this->thread->id);
        $response->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        // Given we have a thread
        // And that thread includes replies
        factory('App\Reply')->create(['thread_id'=>$this->thread->id]);
        // When we visit a thread page
        // Then we should see the replies

    }




}
