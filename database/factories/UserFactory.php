<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'avatar' => $this->faker->imageUrl(130, 130, 'people'),
            'name' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'is_email_verified' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->streetAddress(),
            'country_id' => Country::all()->random()->id,
            'state_id' => State::all()->random()->id,
            'city_id'  => City::all()->random()->id,
            'zip' => $this->faker->postcode,
            'birthdate' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'bio' => $this->faker->paragraph,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
                'is_email_verified' => 0,
            ];
        });
    }
}
