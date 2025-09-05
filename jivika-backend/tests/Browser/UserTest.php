<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testRegisterUser(): void
    {
        $response = $this->json('POST',route("user.register"), [
            "name"=>"User",
            "email"=>"user@gmail.com",
            "password"=>"123456",
            "password_confirmation"=>"123456"
        ]);
        $response->assertStatus(200);
    }
}
