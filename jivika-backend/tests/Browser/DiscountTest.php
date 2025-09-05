<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Tests\DuskTestCase;

class DiscountTest extends DuskTestCase
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
    public function testDiscount(): void
    {
        $faker = Faker::create();
        $LogoFiles = glob('C:/xampp/htdocs/public_html/assets/images/*.{jpg,jpeg,png}', GLOB_BRACE);
        if (!empty($LogoFiles)) {
            $randomLogo = $LogoFiles[array_rand($LogoFiles)];
            $this->browse(function (Browser $browser) use ($randomLogo,$faker) {
                $int= mt_rand(1262055681,1262055681);
                $type = $faker->randomElement(['fix', 'percentage']);
                $browser->visit('/admin/discount')->pause(1000)->waitForText('Discounts')
                ->assertVisible('#discount-table')
                    ->press('.discount_btn')
                    ->pause(1000)->assertSee('Discount')
                    ->type('code', substr(md5(time()), 0, 8))
                    ->type('start_date', date("m/d/Y H:i:s",$int))
                    ->type('end_date', date("m/d/Y H:i:s",$int))
                    ->type('value', rand(1, 99))
                    ->select('select[name="type"]', $type)
                    ->type('max_users_limit', rand(1, 1000))
                    ->type('max_limit', rand(1, 1000))
                    ->scrollIntoView('.save_discount')
                    ->press('Add')
                    ->pause(1000)->assertSee('Discounts');
                    // ->waitFor('.category_edit_15')->click('.category_edit_15')
                    // ->pause(1000)->assertSee('Category')
                    // ->type('name', 'Update Category')
                    // ->scrollIntoView('.save_discount')
                    // ->press('Update')
                    // ->pause(1000)->assertSee('Categories');
            });
        }
    }
}
