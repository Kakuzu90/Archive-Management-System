<?php

namespace Database\Seeders;

use App\Models\BookReview;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BookReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get("database/data/review.json");
        $json = json_decode($file);

        foreach ($json as $item) {
            BookReview::create([
                "book_id" => $item->book_id,
                "user_id" => $item->user_id,
                "rate" => $item->rate,
                "comment" => $item->comment
            ]);
        }
    }
}
