<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test 
     */
    public function an_unauthenticated_user_may_not_particiapte_in_forum_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        //Given we have an unauthenticated user
        $thread   = factory('App\Thread')->create();
        
        $reply = factory('App\Reply')->create();
        
        $this->post($thread->path() . '/replies', $reply->toArray())->assertRedirect('login');
    }
    
    /**
     * @test 
     */
    public function an_authenticated_user_may_particiapte_in_forum_threads()
    {
        //RepliesController->__construct() has
        //has this line  
        //$this->middleware('auth');
        //Given we have an authenticated user
        //$user   = factory('App\User')->create(); <==This line makes unauthenticated. H
        
        $this->be($user = factory('App\User')->create()); //<==This line makes authenticated user.
                                                          //Seems like this goes thru Replies
                                                          //Controll construct method.
        
        //and an existing thread
        $thread = factory('App\Thread')->create();
        
        //When the user adds a reply to the thread
        //$reply = factory('App\Reply')->create();
        //$reply = factory('App\Reply')->make();
        $reply = factory('App\Reply')->create(['thread_id'=>$thread->id]);
        
        //Simulation as if hitting submit button.
        //$this->post('/threads/' . $thread->id . '/replies', $reply->toArray());
        //Getting Expected status code 200 but received 302.
        //Failed asserting that false is true.

        //$this->post('/threads/' . $thread->id . '/replies', $reply->toArray())->assertStatus(200);
        //302 means URL redirection.
        //$this->post('/threads/' . $thread->id . '/replies', $reply->toArray())->assertStatus(302);
        $this->post($thread->path() . '/replies', $reply->toArray())->assertStatus(302);
        
        //then their reply should be added on the page.
        //This is not recognized as an assertion.
        $this->get($thread->path())
             //->assertSee($reply->body);
             ->assertSeeText($reply->body);
    }
}
