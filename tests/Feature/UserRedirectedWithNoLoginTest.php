<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRedirectedWithNoLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     //if user isnt signed in the redirect to the login page
    public function testUserIsRedirectedWithNoLogin()
    {
        $response = $this->get('/home');
        // check whetehr the user is redirect to the login page
        $response->assertRedirect(route('login'));
    }
}
