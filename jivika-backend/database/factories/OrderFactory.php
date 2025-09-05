<?php

namespace Database\Factories;

use App\Http\Admin\Payment\Models\Order;
use App\Http\Admin\Payment\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Order::class;
    public function definition()
    {
        $user = User::whereHas('roles',function($data){
            $data->where('name','customer');
        })->inRandomOrder()
        ->firstOrFail();
        return [
            'user_id'=>$user->id,
            'total_amount'=>$this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['pending', 'completed','cancelled']),
            'order_id'=>Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now')
        ];
    }
}
