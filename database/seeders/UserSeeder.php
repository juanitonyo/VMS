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
        $user =  DB::table('users')->insert([
            'name'=> 'Dexter Castillo',
            'email' => 'dccoc12@gmail.com',
            'password' => Hash::make('asdasd123'),
            'email_verified_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
