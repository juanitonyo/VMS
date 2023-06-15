<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfRoles = [
            'system-admin' => 'System Administrator',
            'system-tester' => 'System Tester'
        ];

        foreach ($arrayOfRoles as $name => $title) {

            $user = DB::table('roles')->insert([
                'name' => $name,
                'title' => $title,
                'created_at' => now(),
            ]);
        }
    }
}