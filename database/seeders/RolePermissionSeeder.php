<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = DB::table('roles')->get(['id', 'name']);
        $permissions = DB::table('permissions')->get(['id']);

        foreach ($roles as $role_key => $role_value) {
            
            foreach ($permissions as $permission_key => $permission_value) {

                $role_permissions =  DB::table('role_permissions')->insert([
                    'role_id'=> $role_value->id,
                    'permission_id' => $permission_value->id,
                    'created_at' => now(),
                ]);
            }
        }
    }
}
