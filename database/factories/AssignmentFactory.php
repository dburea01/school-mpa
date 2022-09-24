<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $startDate = $this->faker->date();

        return [
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date('Y-m-d', $startDate),
            'comment' => $this->faker->sentence(),
        ];
    }
}
