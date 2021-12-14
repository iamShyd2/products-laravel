<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    function run()
    {
        User::create([
          "name" => "Admin",
          "email" => "admin@gmail.com",
          "password" => bcrypt("password"),
        ]);
    }
}
