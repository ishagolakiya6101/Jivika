<?php

namespace Database\Factories;

use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\Service\Models\ServicePackage;
use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Booking::class;
    public function definition()
    // {
    //     $order = Order::inRandomOrder()->firstOrFail();
    //     $package = ServicePackage::inRandomOrder()->firstOrFail();
    //     $provider = ServiceProvider::whereHas('services',function($service) use($package){
    //         $service->where('service_id',$package->service_id);
    //     })->inRandomOrder()->firstOrFail();
    //     return [
    //         'package_id'=>$package->id,
    //         'order_id'=>$order->id,
    //         'quantity'=>rand(1,5),
    //         'price'=>$package->price,
    //         'service_provider_id'=>$provider->id,
    //         'created_at' => $this->faker->dateTimeBetween('-6 month', 'now'),
    //         'updated_at' => $this->faker->dateTimeBetween('-6 month', 'now')
    //     ];
    // }
    {
        $order = Order::inRandomOrder()->firstOrFail();
        $package = ServicePackage::inRandomOrder()->firstOrFail();
        
        $provider = ServiceProvider::whereHas('services', function ($query) use ($package) {
            $query->where('service_id', $package->service_id);
        })->inRandomOrder()->firstOrFail();
        
        return [
            'package_id' => $package->id,
            'order_id' => $order->id,
            'quantity' => rand(1, 5),
            'price' => $package->price,
            'service_provider_id' => $provider->id,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
