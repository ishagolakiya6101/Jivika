<?php

namespace Database\Factories;

use App\Http\Testimonial\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TestimonialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Testimonial::class;
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'title' => $this->faker->word,
            'words' => $this->faker->paragraph,
            'author_image' => "https://i.pravatar.cc/300?u=".Str::random(10)
        ];

    }
}
