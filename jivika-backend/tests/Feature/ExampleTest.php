<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->postJson("/api/register", [
            "name"=>"User",
            "email"=>"admin2@gmail.com",
            "password"=>"123456",
            "password_confirmation"=>"123456"
        ]);
        $response->assertStatus(200);
        $response->assertJson(["success" =>'User created successfully']);
        $this->assertDatabaseHas('users', [
            'name' => 'User',
            'email' => 'admin2@gmail.com',
        ]);
    }
}
