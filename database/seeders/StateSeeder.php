<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::truncate();
        $json = File::get(database_path('data/states.json'));
        $data = json_decode($json);
        foreach ($data as $obj) {
            State::create([
                'name' => $obj->name,
                'country_id' => $obj->country_id,
            ]);
        }
    }
}
