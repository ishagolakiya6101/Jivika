<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    // use DatabaseMigrations;
    /**
     * A basic browser test example.
     */
    public function testloginfail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('admin/login')
            ->assertSee('Welcome')
            ->type('email','admin@gmail.com')
            ->type('password','Password')
            ->press('Sign in')
            ->pause(1000);
        });
    }
    public function testlogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                    ->assertSee('Welcome')
                    ->type('email','homadi7968@hupoi.com')
                    ->type('password','Password')
                    ->press('Sign in');
                    // ->visit('/admin/category')->assertSee('Categories')
                    // ->press('.category_btn')
                    // ->pause(1000)->assertSee('Category')
                    // ->type('name','Home')
                    // ->scrollIntoView('.save_category')
                    // ->press('Add')
                    // ->pause(1000)->assertSee('Categories');
        });
    }
    public function testSettings(): void
    {
        $this->browse(function (Browser $browser) {
            $LogoFiles = glob('C:/Users/ISHA/Downloads/vuexy_v9.5.0/html-version/Bootstrap5/vuexy-bootstrap-html-admin-template/assets/img/branding/*', GLOB_BRACE);
            $BgFiles = glob('C:/Users/ISHA/Downloads/vuexy_v9.5.0/html-version/Bootstrap5/vuexy-bootstrap-html-admin-template/assets/img/backgrounds/*', GLOB_BRACE);
            if (!empty($LogoFiles)) {
                $randomLogo = $LogoFiles[array_rand($LogoFiles)];
                $randomBg = $BgFiles[array_rand($BgFiles)];
            $browser->visit('/admin/settings')->assertSee('Settings')
                    ->type('name','Urban Service')
                    ->attach('bg_image', $randomBg)
                    ->attach('logo', $randomLogo)
                    ->attach('favicon', "C:/Users/ISHA/Downloads/vuexy_v9.5.0/html-version/Bootstrap5/vuexy-bootstrap-html-admin-template/assets/img/favicon/favicon.ico")
                    ->press('Settings')->pause(1000);
            }else{
                $this->fail('No image files found in the specified directory.');
            }
        });
    }
    
}
