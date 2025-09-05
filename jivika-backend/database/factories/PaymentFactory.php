<?php

namespace Database\Factories;

use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\Payment\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Payment::class;
    public function definition()
    {
        $order = Order::inRandomOrder()->firstOrFail();
        return [
            'user_id'=>$order->user_id,
            'amount' => $order->total_amount,
            'status' => $this->faker->randomElement(['completed', 'failed']),
            'order_id' => $order->id,
            'created_at' => $this->faker->dateTimeBetween('-6 month', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 month', 'now')
        ];
    }
}
