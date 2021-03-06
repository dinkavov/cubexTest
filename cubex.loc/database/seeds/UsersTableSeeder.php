<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => 'email@example.com',
            'password' => bcrypt('123456'),
            'isAdmin' => 1
        ]);
    }
}
