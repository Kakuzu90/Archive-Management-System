<?php

namespace Database\Seeders;

use App\Models\BookDownload;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BookDownloadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get("database/data/download.json");
        $json = json_decode($file);

        foreach ($json as $item) {
            BookDownload::create([
               "book_id" => $item->book_id,
               "user_id" => $item->user_id,
            ]);
        }
    }
}
