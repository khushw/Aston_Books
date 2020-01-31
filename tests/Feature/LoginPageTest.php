<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginPageTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

     //all functions have to start with test
     //just to test that the login url works
    public function testLoginPage()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
