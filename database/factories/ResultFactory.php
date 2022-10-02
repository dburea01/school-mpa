<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'note_num' => random_int(0, 2000) / 100,
            'note_alpha' => fake()->randomElement(['A', 'B', 'C', 'D', 'E', 'F']),
            'comment' => fake()->sentence(),
        ];
    }
}
