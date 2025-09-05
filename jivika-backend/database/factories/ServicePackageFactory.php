<?php

namespace Database\Factories;

use App\Http\Admin\Service\Models\ServicePackage;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ServicePackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ServicePackage::class;
    public function definition()
    {
        $service = Service::inRandomOrder()->first(); // Get a random service
        return [
            'service_id' => $service->id,
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 500),
            'included' => $this->faker->sentence,
            'excluded' => $this->faker->sentence,
            'how_work' => $this->faker->paragraph,
            'duration' => $this->faker->numberBetween(1, 30),
            'image' => $this->faker->imageUrl(),
            'created_at' => $this->faker->dateTimeBetween('-6 month', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 month', 'now')
        ];
    }
}
