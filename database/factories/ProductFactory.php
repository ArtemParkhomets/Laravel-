<?php

namespace Database\Factories;

use App\Models\Product;
use Faker\Provider\Address;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->word,
            'description'   => $this->faker->sentence,
            'price'         => rand(1,10000),
            'categories_id' => rand(1,5),
            'title_slug'    => Str::slug('title'),
        ];
    }
}
