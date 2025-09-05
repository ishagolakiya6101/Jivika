<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Tests\DuskTestCase;

class PackageTest extends DuskTestCase
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
            $this->browse(function (Browser $browser) use ($randomLogo, $faker) {
                $int = mt_rand(1262055681, 1262055681);
                $browser->visit('/admin/packages')->pause(1000)->waitForText('Packages')
                ->assertVisible('#servicepackage-table')
                    ->press('.package_btn')
                    ->pause(1000)->assertSee('Package')
                    ->select('service_id', '1')
                    ->type('name', $faker->name);
                    // ->type('description')
                    $browser->scrollIntoView('#description_quill')->script('document.querySelector("#description_quill .ql-editor").innerHTML = "This is the description_quill for the Quill editor.";');
                    $browser->scrollIntoView('#included_quill')->script('document.querySelector("#included_quill .ql-editor").innerHTML = "This is the included_quill for the Quill editor.";');
                    $browser->scrollIntoView('#how_work_quill')->script('document.querySelector("#how_work_quill .ql-editor").innerHTML = "This is the how_work_quill for the Quill editor.";');
                    $browser->scrollIntoView('#excluded_quill')->script('document.querySelector("#excluded_quill .ql-editor").innerHTML = "This is the excluded_quill for the Quill editor.";');
                    $browser->scrollIntoView('#price')->type('price', rand(10, 100))
                    ->scrollIntoView('#duration')->type('duration', '2 hours') 
                    ->scrollIntoView('#image')->attach('image', $randomLogo)
                    ->scrollIntoView('.save_package')
                    ->press('Add')
                    ->pause(1000)->assertSee('Packages');
            });
        }
    }
}
