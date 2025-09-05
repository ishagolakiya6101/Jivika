<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Tests\DuskTestCase;

class ServiceTest extends DuskTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                ->assertSee('Welcome')
                ->type('email', 'homadi7968@hupoi.com')
                ->type('password', 'Password')
                ->press('Sign in');
        });
    }
    public function testService()
    {
        
        $faker = Faker::create();
        $LogoFiles = glob('C:/xampp/htdocs/public_html/assets/images/*.{jpg,jpeg,png}', GLOB_BRACE);
        if (!empty($LogoFiles)) {
            $randomLogo = $LogoFiles[array_rand($LogoFiles)];
            $this->browse(function (Browser $browser) use ($randomLogo,$faker) {
                $int= mt_rand(1262055681,1262055681);
                $type = $faker->randomElement(['fix', 'percentage']);
                $browser->visit('/admin/services')->pause(1000)->waitForText('Services')
                ->assertVisible('#service-table')
                    ->press('.service_btn')
                    ->pause(1000)->assertSee('Service')
                    ->type('name',$faker->name)
                    // ->type('description')
                    ->scrollIntoView('.save_service')
                    ->select('category_id', '1')    
                    ->type('price', rand(10, 100))
                    ->type('offer_price', rand(5, 50))
                    ->attach('image', $randomLogo)
                    ->press('Add')
                    ->pause(1000)->assertSee('Services');
            });
        }
    }
}
