<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;   //5.5
//use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    //use DatabaseMigrations;
    use RefreshDatabase;
   
    public function setup()
    {
        parent::setUp();
        
        $this->thread = factory('App\Thread')->create();
        
    }
    /** @test  */
    public function a_user_can_browse_all_threads()
    {
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }
    
    /** @test  */
    public function a_user_can_see_title()
    {
        
        $response = $this->get('/threads')

                         ->assertSee($this->thread->title);
    }
    /** @test  */
    public function a_user_can_see_a_single_thread()
    {
        
        $response = $this->get('/threads/' . $this->thread->id)

                         ->assertSee($this->thread->title);
    }
    
    /** @test **/
    public function a_user_can_read_replies_to_a_thread()
    { 
        //Create a reply of a thread.
        $reply = factory('App\Reply')
               ->create(['thread_id' => $this->thread->id]);
        
        //When we visit a thread page
        //We should see replies.
        $response = $this->get('/threads/'. $this->thread->id)
                         ->assertSee($reply->body);
        
        
    }
}