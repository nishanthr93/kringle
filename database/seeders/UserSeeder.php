<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
            'name' => 'admin',
            'email' => "admin@gmail.com",
            "password" => bcrypt('admin@123'),
            "role_id" => Roles::IS_ADMIN
        ]);
        User::Create([
            'name' => 'manager',
            'email' => "manager@gmail.com",
            "password" => bcrypt('manager@123'),
            "role_id" => Roles::IS_MANAGER
        ]);
        User::Create([
            'name' => 'Test',
            'email' => "test@gmail.com",
            "password" => bcrypt('test@123'),
            "role_id" => Roles::IS_USER
        ]);
    }
}
