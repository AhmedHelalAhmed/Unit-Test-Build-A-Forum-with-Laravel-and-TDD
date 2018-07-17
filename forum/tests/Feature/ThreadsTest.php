<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;



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
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads');
        $response->assertSee($thread->title);

    }


    /** @test */
    public function a_user_can_read_a_single_threads()
    {
        //test3 : user can show one thread
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);

    }




}
