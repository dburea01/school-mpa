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
        $schoolName = $this->faker->word;

        return [
            'name' => 'Ecole ' . $schoolName,
            'address1' => $this->faker->streetAddress(),
            'zip_code' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country_id' => 'FR',
        ];
    }
}
