<?php

namespace Database\Factories;

use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Http\Admin\ServiceProvider\Models\ServiceProvider>
 */
class ServiceProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ServiceProvider::class;
    public function definition()
    {
        $user = User::whereDoesntHave('provider')->whereHas('roles',function($data){
            $data->where('name','freelancer');
        })->inRandomOrder()
        ->firstOrFail();
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'user_id' => $user->id,
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at
        ];

    }
}
