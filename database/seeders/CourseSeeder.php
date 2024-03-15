<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get("database/data/course.json");
        $json = json_decode($file);

        foreach ($json as $item) {
            Course::create([
                "name" => $item->name,
                "slug"=> $item->name,
                "college_id" => $item->college_id
            ]);
        }
    }
}
