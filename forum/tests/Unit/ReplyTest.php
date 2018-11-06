<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @test 
     */
    public function it_has_an_owner()
    {
        $reply = factory('App\Reply')->create();
        
        $this->assertInstanceOf('App\User', $reply->owner);
        //$this->assertInstanceOf('App\Owner', $reply->owner);
    }
}