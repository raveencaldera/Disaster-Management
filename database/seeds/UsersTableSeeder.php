<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"          => "Admin User",
            "email"         => "admin@user.com",
            "role"          => "admin",
            "verified"      => true,
            "password"      => bcrypt('123456')
        ]);

        User::create([
            "name"          => "Manager User",
            "email"         => "manager@user.com",
            "role"          => "manager",
            "verified"      => true,
            "password"      => bcrypt('123456')
        ]);

        User::create([
            "name"          => "Reporter User",
            "email"         => "reporter@user.com",
            "role"          => "reporter",
            "verified"      => true,
            "password"      => bcrypt('123456')
        ]);
    }
}
