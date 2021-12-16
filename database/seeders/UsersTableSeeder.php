<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'User1',
            'email' => 'user1@email.com',
            'username' => 'user1',
            'balance' => 200,
            'rewards' => 0,
            'password' => bcrypt('pass1234'),
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'User2',
            'email' => 'user2@email.com',
            'username' => 'user2',
            'balance' => 500,
            'rewards' => 0,
            'password' => bcrypt('pass1234'),
        ]);
    }
}
