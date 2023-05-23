<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = DB::table('users')->insert([
            'role_id' => 1,
            'name' => 'Dexter Castillo',
            'email' => 'sysadmin@gmail.com',
            'password' => Hash::make('sysadmin'),
            'email_verified_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s'),
        ]);
    }
}