<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserLoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    private $accessToken;
    public function test_example()
    {
        $response = $this->postJson("/api/login", [
            "email"=>"admin2@gmail.com",
            "password"=>"123456",
        ]);
        $response->assertStatus(200);
        $token = $response->json('token');
        $accessToken = $token;
        $response  = $this->withHeaders([
            'accept'=>'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ])->postJson('/api/address/store', [
            "flat_building_no"=>"201",
            "street"=>"rupali soc.",
            "city"=>"surat",
            "state"=>"gujarat",
            "zip_code"=>"395008",
            "state"=>"gujarat",
            "country"=>"India",
            "landmark"=>"hirabaug",
            "address_type"=>1
        ]);
        $response->assertStatus(200);
    }
}
