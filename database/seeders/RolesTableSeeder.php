<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
                'status'=> '1'
            ],
            [
                'id'    => 2,
                'title' => 'Retailer',
                'status'=> '1'
            ],
        ];

        Role::insert($roles);
    }
}
