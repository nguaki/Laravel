<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;   //5.5
//use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    //use DatabaseMigrations;
    use RefreshDatabase;
    
    /** @test  */
    public function a_user_can_browse_all_threads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
    
    /** @test  */
    public function a_user_can_see_title()
    {
        $thread = factory('App\Thread')->create();
        
        $response = $this->get('/threads');

        $response->assertSee($thread->title);
    }
    /** @test  */
    public function a_user_can_see_a_single_thread()
    {
        $thread = factory('App\Thread')->create();
        
        $response = $this->get('/threads/' . $thread->id);

        $response->assertSee($thread->title);
    }
}