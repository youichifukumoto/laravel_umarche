<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            'owner_id' => 1,
            'name' => 'test',
            'email' => 'test@test.com',
            'betting_rate' => '60',
            'password' => Hash::make('password123'),
            'created_at' => '2021/01/01 11:11:11'
        ]);

        DB::table('users')->insert([
            'owner_id' => 2,
            'name' => 'test2',
            'email' => 'test2@test.com',
            'betting_rate' => '60',
            'password' => Hash::make('password123'),
            'created_at' => '2021/01/01 11:11:11'
        ]);
    }
}
