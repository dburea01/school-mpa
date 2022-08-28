<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
            'status' => fake()->randomElement(['ACTIVE', 'INACTIVE']),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('azerty'),
            'birth_date' => $this->faker->date('d/m/Y'),
            'gender_id' => $this->faker->randomElement(['1', '2']),
            'comment' => $this->faker->paragraphs(3, true),
            'created_by' => 'factory',
            // 'email_verified_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
