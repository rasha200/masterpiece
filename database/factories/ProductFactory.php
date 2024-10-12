<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\Category;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => 'default.jpg', 
            'price' => $this->faker->randomFloat(2, 1, 1000), 
            'quantity' => $this->faker->numberBetween(1, 100), 
            'category_id' => Category::inRandomOrder()->first()->id ?? null, 
        ];
    }
}
