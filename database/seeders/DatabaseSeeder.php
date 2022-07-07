<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryVideo;
use App\Models\User;
use App\Models\Channel;
use App\Models\ChannelVideo;
use App\Models\Comment;
use App\Models\History;
use App\Models\Subscription;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //disable foreign key check for this connection before running seeders
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Channel::truncate();
        Subscription::truncate();
        Video::truncate();
        ChannelVideo::truncate();
        CategoryVideo::truncate();
        Category::truncate();
        History::truncate();
        Comment::truncate();
        Schema::enableForeignKeyConstraints();

        $this->call(UserSeeder::class);
        $this->call(VideoSeeder::class);
    }
}
