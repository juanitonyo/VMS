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
            'dashboard' => ['view' => 'View'],
            'users' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'roles' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'settings' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'buildings' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'visitors' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'deliveries' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'sync' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'expected' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'invite' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
            'qrcode' => ['view' => 'View', 'create' => 'Create', 'update' => 'Update'],
        ];

        foreach ($arrayOfPermissions as $module => $permissions) {

            foreach ($permissions as $name => $title) {
                $user =  DB::table('permissions')->insert([
                    'module'=> $module,
                    'name'=> $name,
                    'title' => $title,
                    'created_at' => now(),
                ]);
            }
        }
    }
}
