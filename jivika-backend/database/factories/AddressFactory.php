<?php

namespace Database\Factories;

use App\Http\Admin\Address\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Address::class;
    public function definition()
    {
        $user = User::whereDoesntHave('address')->inRandomOrder()
            ->firstOrFail();
        return [
            'user_id'=>$user->id,
            'flat_building_no'=>$this->faker->buildingNumber,
            'street'=>$this->faker->streetName,
            'city'=>$this->faker->city,
            'state'=>$this->faker->state,
            'zip_code'=>$this->faker->postcode,
            'country'=>$this->faker->country,
            'landmark'=>$this->faker->secondaryAddress,
            'address_type'=>$this->faker->boolean(50),
            'default_address'=>1
        ];
    }
}
