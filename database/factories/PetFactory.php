<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(1, 15), 
            'gender' => $this->faker->randomElement(['male', 'female']),
            'type' => $this->faker->randomElement(['dog', 'cat', 'bird', 'rabbit', 'hamster']), 
            'information' => $this->faker->sentence(),
            'image' => 'default.jpg', 
            'is_adopted' =>'no',
        ];
    }
}
