<?php

namespace Database\Factories;

use App\Http\Admin\ServiceProvider\Models\Booking;
use App\Http\Front\Order\Models\OrderItem;
use App\Http\Front\Review\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Review::class;
    public function definition()
    {
        $order = Booking::inRandomOrder()->firstOrFail();
        $user = User::whereHas('roles',function($data){
            $data->where('name','customer');
        })->inRandomOrder()->firstOrFail();
        return [
            'service_id'=>$order->package->service_id,
            'user_id'=>$user->id, 
            'booking_id'=>$order->id,
            'service_provider_id'=>$order->service_provider_id,
            'ratings' => $this->faker->numberBetween(1, 5),
            'review_text' => $this->faker->paragraph,
            'created_at' => $this->faker->dateTimeBetween('-6 month', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 month', 'now')
        ];
    }
}
