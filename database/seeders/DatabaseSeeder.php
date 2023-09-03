<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            ["name" => ucfirst("user")],
            ["name" => ucfirst("admin")],
        ];

        $user = [
            ["name" => ucfirst("andik"), "username" => "andik", "password" => bcrypt("andik"), "role_id" => 2],
        ];

        Role::insert($role);
        User::insert($user);
    }
}
