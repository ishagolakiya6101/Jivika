<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Yajra\DataTables\DataTables;
use Faker\Factory as Faker;

class CategoryTest extends DuskTestCase
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
    public function testCategory(): void
    {
        $faker = Faker::create();
        $LogoFiles = glob('C:/Users/ISHA/Downloads/vuexy_v9.5.0/html-version/Bootstrap5/vuexy-bootstrap-html-admin-template/assets/img/branding/*', GLOB_BRACE);
        if (!empty($LogoFiles)) {
            $randomLogo = $LogoFiles[array_rand($LogoFiles)];
            $this->browse(function (Browser $browser) use ($randomLogo,$faker) {
                $browser->visit('/admin/category')->pause(1000)->waitForText('Categories')
                ->assertVisible('#category-table')
                    ->press('.category_btn')
                    ->pause(1000)->assertSee('Category')
                    ->type('name', $faker->name)
                    // ->type('description', 'Category Description')
                    ->attach('image', $randomLogo)
                    ->scrollIntoView('.save_category')
                    // ->script("document.querySelector('#description_quill').innerText = '{$descriptionValue}';")
                    ->press('Add')
                    ->pause(1000)->assertSee('Categories')
                    ->waitFor('.category_edit_1')->click('.category_edit_1')
                    ->pause(1000)->assertSee('Category')
                    ->type('name', $faker->name)
                    ->attach('image', $randomLogo)
                    ->scrollIntoView('.save_category')
                    ->press('Update')
                    ->pause(1000)->assertSee('Categories');
                    // $browser->on('dataTables_processing', function (Browser $categoryPage) {
                    //     // Use the DataTable methods to locate and interact with elements
                    //     $categoryPage->within(new DataTables('#category-table'), function ($table) {
                    //         // Assuming a checkbox for each row with a 'delete-checkbox' class
                    //         $table->checkRow('9');
            
                    //         // Assuming a delete button with a 'delete-button' class
                    //         $table->click('.category_delete_9');
                    //     });
                    // });
                    // ->waitFor('.category_delete_9')->click('.category_delete_9')
                    // ->waitFor('.swal2-icon')->click('.swal2-confirm')->pause(1000)
                    // ->waitFor('.category_delete_8')->click('.category_delete_8')
                    // ->waitFor('.swal2-icon')->click('.swal2-confirm')->pause(1000)
                    // ->waitFor('.category_delete_7')->click('.category_delete_7')
                    // ->waitFor('.swal2-icon')->click('.swal2-confirm')->pause(1000);
            });
        }
    }
    // public function testCategoryUpdate(): void
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/admin/category')->assertSee('Categories')
    //             ->waitFor('.category_edit_12')->click('.category_edit_12')
    //             ->pause(1000)->assertSee('Category')
    //             ->type('name', 'Update Category')
    //             ->scrollIntoView('.save_category')
    //             ->press('Update')
    //             ->pause(1000)->assertSee('Categories');
    //     });
    // }
    // public function testCategoryUpdateOnDelete(): void
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/admin/category')->assertSee('Categories')
    //         ->waitFor('.category_edit_12')->click('.category_edit_12');
    //             $browser->withNewTab(function ($newTab) {
    //                 $newTab->assertUrlIs(url('admin/category/create?category_id=12'));
    //             });
    //     });
    // }
}
