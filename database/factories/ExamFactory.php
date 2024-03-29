<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exam>
 */
class ExamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = fake()->dateTime()->format('d/m/Y H:i');
        $endDate = fake()->dateTime()->format('d/m/Y H:i');

        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'instruction' => fake()->paragraph(),
        ];
    }
}
