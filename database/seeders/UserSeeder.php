<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory(100)
            ->has(Channel::factory()->count(rand(1, 5)))
            ->create();

        $subscriptions = Channel::pluck('id');
        User::factory(100)
            ->create()
            ->each(function ($user) use ($subscriptions) {
                $user->Subscriptions()->attach($subscriptions->random(rand(1, 5), ['status' => 1]));
            });
    }
}
