<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'video' => $this->faker->url,
            'cover' => $this->faker->imageUrl(1500, 386),
            'title' => $this->faker->sentence,
            'about' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['1', '2']),
            'monetize' => $this->faker->randomElement(['0', '1']),
            'status' => $this->faker->randomElement(['1', '2', '3']),
            'license' => $this->faker->sentence,
            'lang' => $this->faker->randomElement(['En', 'Es']),
            'cast' => $this->faker->sentence,
            'views' => $this->faker->numberBetween(10, 1000),
            'likes' => $this->faker->numberBetween(10, 1000),
            'dislikes' => $this->faker->numberBetween(10, 1000),
            'user_id' => User::all()->random()->id
        ];
    }
}
