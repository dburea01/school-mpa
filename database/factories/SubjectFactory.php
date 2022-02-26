<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition()
    {
        return [
            'short_name' => strtoupper($this->faker->text(10)),
            'name' => $this->faker->word,
            'status' => $this->faker->randomElement(['ACTIVE', 'INACTIVE']),
            'option' => false,
            'created_by' => 'factory',
            'comment' => $this->faker->sentence()
        ];
    }
}
