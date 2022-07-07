<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'about' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(130, 130),
            'cover' => $this->faker->imageUrl(1500, 386),
            'status' => $this->faker->randomElement(['1', '2']),
            'subscriptions' => $this->faker->numberBetween(10, 1000),
            'user_id' => User::all()->random()->id,
        ];
    }
}
