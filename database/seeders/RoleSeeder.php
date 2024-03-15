<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = File::get("database/data/role.json");
        $json = json_decode($roles);

        foreach ($json as $role) {
            Role::create([
                "name" => $role->name,
                "slug"=> $role->name,
            ]);
        }
    }
}
