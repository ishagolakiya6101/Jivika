<?php

namespace Database\Seeders;

use App\Http\Admin\ServiceProvider\Models\ServiceProviderAddress;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServiceProviderAddressSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            ServiceProviderAddress::create([
                'service_provider_id' => 1, // Replace with the actual service provider ID
                'flat_building_no' => 'Address ' . $i,
                'street' => 'Example Street ' . $i,
                'city' => 'Surat',
                'state' => 'Gujarat',
                'zip_code' => '39500' . $i,
                'country' => 'India',
                'landmark' => 'Near Landmark ' . $i,
                'latitude' => 21.1702 + ($i * 0.01), // Slightly varying latitude for each address
                'longitude' => 72.8311 + ($i * 0.01), // Slightly varying longitude for each address
            ]);
        }
    }
}
