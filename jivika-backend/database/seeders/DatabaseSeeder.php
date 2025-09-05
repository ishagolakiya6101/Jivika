<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\Payment\Models\Payment;
use App\Http\Admin\Service\Models\ServicePackage;
use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Http\Front\Order\Models\OrderItem;
use App\Http\Front\Review\Models\Review;
use App\Models\Admin;
use App\Models\Service;
use App\Models\ServiceProviderService;
use App\Models\User;
use App\Models\UserService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $role = Role::updateOrCreate(['name'=>'freelancer'],['name'=>'freelancer']);
        $user_role = Role::updateOrCreate(['name'=>'customer'],['name'=>'customer']);
        Admin::updateOrCreate(['email' => 'admin@gmail.com'],[
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Password')
        ]);
        User::updateOrCreate(['email' => 'customer@gmail.com'],[
            'first_name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole($user_role);
        
        $freelancer = User::updateOrCreate(['email' => 'freelancer@gmail.com'],[
            'first_name' => 'Freelancer',
            'email' => 'freelancer@gmail.com',
            'password' => Hash::make('password')
        ])->assignRole($role);
        $service =Service::first();
        $provider = ServiceProvider::updateOrCreate(['user_id'=>$freelancer->id],[
            'user_id'=>$freelancer->id,
        ]);
        ServiceProviderService::updateOrCreate([
            'service_provider_id'=>$provider->id,
            'service_id'=>$service->id
        ],
        [
            'service_provider_id'=>$provider->id,
            'service_id'=>$service->id
        ]);
        User::factory(50)->create()->each(function ($user) use($user_role) {
            $user->assignRole($user_role);
        });
        $users = User::factory(50)->create()->each(function ($user) use($role) {
            $user->assignRole($role);
        });
        foreach($users as $data)
        {
            ServiceProvider::factory()->create();
        }
        ServicePackage::factory(50)->create();
        ServiceProviderService::factory(100)->create();
        Order::factory(37)->create();
        Payment::factory(40)->create();
        Booking::factory(50)->create();
        Review::factory(100)->create();
    }
}
