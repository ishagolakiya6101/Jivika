<?php

namespace Database\Factories;

use App\Http\Admin\ServiceProvider\Models\ServiceProvider;
use App\Models\Service;
use App\Models\ServiceProviderService;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceProviderService>
 */
class ServiceProviderServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ServiceProviderService::class;
    public function definition()
    {
        $user = ServiceProvider::inRandomOrder()->firstOrFail();
        $service = Service::inRandomOrder()->firstOrFail();
        return [
            'service_provider_id'=>$user->id,
            'service_id'=>$service->id,
            'created_at' => $service->created_at,
            'updated_at' => $service->updated_at
        ];
    }
}
