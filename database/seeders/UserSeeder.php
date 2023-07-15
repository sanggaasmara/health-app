<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "roles" => "admin",
                "password" => Hash::make("password")
            ],
            [
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("password")
            ],

        ];

        foreach ($data as $key => $value) {
            User::create($value);
        }
    }
}
