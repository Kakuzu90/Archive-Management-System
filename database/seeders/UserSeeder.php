<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get("database/data/user.json");
        $json = json_decode($file);

        foreach ($json as $item) {
            User::create([
                "first_name" => $item->first_name,
                "middle_name" => $item->middle_name,
                "last_name" => $item->last_name,
                "username" => $item->username,
                "password" => $item->password,
                "college_id" => $item->college_id,
                "role_id" => $item->role_id,
                "year_level" => $item->year_level ?? null,
                "avatar" => $item->avatar,
                "verified_at" => $item->role_id === Role::SUPER_ADMIN ? Carbon::now() : null,
            ]);
        }
    }
}
