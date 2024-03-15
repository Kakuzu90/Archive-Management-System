<?php

namespace Database\Seeders;

use App\Models\BookReview;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            CollegeSeeder::class,
            CourseSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            BooksSeeder::class,
            BookReviewSeeder::class,
            BookDownloadSeeder::class,
        ]);
    }
}
