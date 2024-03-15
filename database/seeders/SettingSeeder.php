<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = File::get("database/data/setting.json");
        $json = json_decode($file);

        foreach ($json as $item) {
            Setting::create([
                "title" => $item->name,
                "context"=> $item->context,
                "setting_type" => $item->setting_type,
            ]);
        }
    }
}
