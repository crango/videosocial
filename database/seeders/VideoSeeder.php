<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Channel;
use App\Models\Video;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Category::factory()->count(10)->create();

        $channels = Channel::pluck('id');
        $categories = Category::pluck('id');
        $histories = User::pluck('id');
        $comments = User::pluck('id');

        Video::factory(100)
            ->create()
            ->each(function ($video) use ($channels, $categories, $histories, $comments, $faker) {
                $video->Channels()->attach($channels->random(rand(1, 5)));
                $video->Categories()->attach($categories->random());
                $video->Histories()->attach($histories->random(rand(1, 10)));
                $video->Comments()->attach($comments->random(rand(1, 3)), ['comment' => $faker->sentence]);
            });

        // Video::factory(10)
        //     ->create()
        //     ->each(function ($video) use ($channels) {
        //         $video->channels()->attach($channels->random(rand(1, 10)));
        //     })->each(function ($video) use ($categories) {
        //         $video->categories()->attach($categories->random());
        //     });
    }
}
