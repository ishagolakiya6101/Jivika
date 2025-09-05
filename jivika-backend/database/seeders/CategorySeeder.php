<?php

namespace Database\Seeders;

use App\Http\Admin\Service\Models\ServicePackage;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $data = [
            [
                'name' => 'Design & Multimedia',
                'description' => $faker->sentence(20),
                'image'=> "https://placehold.co/600x400?text=Design+&+Multimedia",
                'services' => [
                    [
                        'name' => 'Graphic Design',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Graphic+Design"
                    ],
                    [
                        'name' => 'Web Design',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Web+Design"
                    ],
                    [
                        'name' => 'Illustration',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Illustration"
                    ],
                    [
                        'name' => 'Animation',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Animation"
                    ],
                    [
                        'name' => 'Photography',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Photography"
                    ],
                    [
                        'name' => 'Videography',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Videography"
                    ],
                    [
                        'name' => 'Motion Graphics',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Motion+Graphics"
                    ],
                    [
                        'name' => 'Branding & Identity Design',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Branding+&+Identity+Design"
                    ],
                    [
                        'name' => 'UI/UX Design',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=UI/UX+Design"
                    ]
                ]
            ],
            [
                'name' => 'Writing & Content',
                'description' => $faker->sentence(20),
                'image' => "https://placehold.co/600x400?text=Writing+&+Content",
                'services' => [
                    [
                        'name' => 'Copywriting',
                        'description' => $faker->sentence(20),
                        'price' => 450,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Copywriting"
                    ],
                    [
                        'name' => 'Content writing',
                        'description' => $faker->sentence(20),
                        'price' => 450,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Content+writing"
                    ]
                ]
            ],
            [
                'name' => 'Marketing & Promotion',
                'description' => $faker->sentence(20),
                'image' => "https://placehold.co/600x400?text=Marketing+&+Promotion",
                'services'=>[
                    [
                        'name' => 'Social Media Management',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Social+Media+Management"
                    ],
                    [
                        'name' => 'Digital Marketing',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Digital+Marketing"
                    ]
                ]
            ],
            [
                'name' => 'Audio & Visual',
                'description' => $faker->sentence(20),
                'image' => "https://placehold.co/600x400?text=Audio+&+Visual",
                'services' => [
                    [
                        'name' => 'Music Composition',
                        'description' => $faker->sentence(20),
                        'price' => 450,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Music+Composition"
                    ],
                    [
                        'name' => 'Voiceover Services',
                        'description' => $faker->sentence(20),
                        'price' => 450,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Voiceover+Services"
                    ],
                    [
                        'name' => 'Podcast Production',
                        'description' => $faker->sentence(20),
                        'price' => 450,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Podcast+Production"
                    ]
                ]
            ],
            [
                'name' => 'Consulting & Strategy',
                'description' => $faker->sentence(20),
                'image' => "https://placehold.co/600x400?text=Consulting",
                'services'=>[
                    [
                        'name' => 'Creative Consulting',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Creative+Consulting"
                    ]
                ]
            ],
            [
                'name' => 'Product & Space',
                'description' => $faker->sentence(20),
                'image' => "https://placehold.co/600x400?text=Hello+World",
                'services'=>[
                    [
                        'name' => 'Product Design',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Product+Design"
                    ],
                    [
                        'name' => 'Interior Design',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Interior+Design"
                    ],
                    [
                        'name' => 'Fashion Design',
                        'description' => $faker->sentence(20),
                        'price' => 400,
                        'offer_price' => 300,
                        'image' => "https://placehold.co/600x400?text=Fashion+Design"
                    ]
                ]
            ],
        ];
        foreach ($data as $category) {
            $category_data = Category::updateOrCreate(['name' => $category['name']],[
                'name' => $category['name'],
                'description' => $category['description'],
                'image' => $category['image'],
            ]);
            foreach($category["services"] as $service)
            {
                $service['category_id'] = $category_data->id;
                $service_data = Service::updateOrCreate(['name' => $service['name'],'category_id' => $service['category_id']],$service);
                // ServicePackage::create([
                //     'service_id' => $service_data->id,
                //     'name' => fake()->unique()->word,
                //     'description' => fake()->paragraph,
                //     'price' => fake()->randomFloat(2, 10, 500),
                //     'included' => fake()->sentence,
                //     'excluded' => fake()->sentence,
                //     'how_work' => fake()->paragraph,
                //     'duration' => fake()->numberBetween(1, 30),
                //     'image' => fake()->imageUrl(),
                // ]);
            }
        }
    }
}
