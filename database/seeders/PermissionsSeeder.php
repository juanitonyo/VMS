<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayOfPermissions = [
            'manage_user_list' => 'Manage User List',
            'manage_user_roles' => 'Manage User Roles',
            'manage_maintenance' => 'Manage Maintenance',
            'manage_buildings' => 'Manage Buildings',
            'manage_visitors' => 'Manage Visitors',
            'manage_deliveries' => 'Manage Deliveries',
        ];

        foreach ($arrayOfPermissions as $name => $title) {

            $user =  DB::table('permissions')->insert([
                'name'=> $name,
                'title' => $title,
                'created_at' => now(),
            ]);
        }
    }
}
