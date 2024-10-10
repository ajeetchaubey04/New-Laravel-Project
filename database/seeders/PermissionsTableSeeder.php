<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $path = database_path('permissions.json');
        $permissions = json_decode(file_get_contents($path), true); 

        foreach ($permissions as $key => $value) {
            Permission::create(['title' => $value]);
        }
    }
}
