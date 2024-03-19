<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get("database/data/book.json");
        $json = json_decode($file);

        foreach ($json as $item) {
            Books::create([
                "title" => $item->title,
                "slug" => $item->title,
                "book_type" => $item->book_type,
                "user_id" => $item->user_id,
                "college_id" => $item->college_id,
                "course_id" => $item->course_id,
                "authors" => $item->authors,
                "uploaded_by" => $item->uploaded_by,
                "published_at" => Carbon::now(),
            ]);
        }
    }
}
