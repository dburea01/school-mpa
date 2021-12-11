<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Ecole ' . $this->faker->word,
            'zip_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country_id' => 'FR',
            //'school_type_id' => 'LYCEE',
            //'school_status' => 'ACTIVE',
            'max_users' => random_int(10, 100),
            'created_by' => 'factory',
        ];
    }
}
