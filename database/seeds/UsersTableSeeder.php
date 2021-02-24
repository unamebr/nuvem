<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
            'name' => 'Admin Admin',
            'email' => 'basic@material.com',
            'password' => Hash::make('secret'),
            'phone' => '8799998888',
            'user_type' => 'basic',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'advanced@material.com',
            'password' => Hash::make('secret'),
            'phone' => '8799998888',
            'user_type' => 'advanced',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


}