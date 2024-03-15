<?php

namespace Database\Seeders;

use App\Models\College;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colleges = File::get("database/data/college.json");
        $json = json_decode($colleges);

        foreach ($json as $item) {
            College::create([
                "name" => $item->name,
                "slug"=> $item->name,
            ]);
        }
    }
}
