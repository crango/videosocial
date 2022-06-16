<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
        $json = File::get(database_path('data/countries.json'));
        $data = json_decode($json);
        foreach ($data as $obj) {
            Country::create([
                'shortname' => $obj->shortname,
                'name' => $obj->name,
                'phonecode' => $obj->phonecode,
            ]);
        }
    }
}
