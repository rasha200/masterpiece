<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Fname' => $this->faker->firstName(),
            'Lname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'mobile' => $this->faker->phoneNumber(),
            'password' => Hash::make('password'),
            'role' => $this->faker->randomElement(['user', 'receptionist', 'veterinarian', 'manager']),
            'remember_token' => Str::random(10),
        ];
    }
}
