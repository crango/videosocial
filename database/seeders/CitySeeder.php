<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::truncate();
        $json = File::get(database_path('data/cities.json'));
        $data = json_decode($json);
        foreach ($data as $obj) {
            City::create([
                'name' => $obj->name,
                'state_id' => $obj->state_id,
            ]);
        }
    }
}
