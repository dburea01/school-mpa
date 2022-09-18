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
        $genderId = $this->faker->randomElement(['male', 'female']);

        $firstName = $this->faker->firstName($genderId);
        $lastName = $this->faker->lastName();

        return [
            'status' => fake()->randomElement(['ACTIVE', 'INACTIVE']),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => strtolower($firstName) . '.' . strtolower($lastName) . '@' . $this->faker->domainName(),
            'password' => Hash::make('azerty'),
            'birth_date' => $this->faker->date('d/m/Y'),
            'gender_id' => $genderId === 'male' ? '1' : '2',
            'civility_id' => $genderId === 'male' ? 'MR' : 'MISS',
            'comment' => $this->faker->paragraphs(3, true),
            'address1' => $this->faker->streetSuffix() . ' ' . $this->faker->streetName(),
            'address2' => $this->faker->streetName(),
            'city' => $this->faker->city(),
            'zip_code' => $this->faker->postcode,
            'country_id' => $this->faker->randomElement(['FR', 'BE', 'IT']),
            'created_by' => 'factory',
            // 'email_verified_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
