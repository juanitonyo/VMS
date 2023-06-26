<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = DB::table('roles')->get(['id', 'name']);

        foreach ($roles as $role_key => $role) {
            
            switch ($role->name) {
                case 'system-admin':
                    $permissions = DB::table('permissions')->get(['id']);

                    foreach ($permissions as $permission_key => $permission) {

                        $role_has_permissions =  DB::table('role_has_permissions')->insert([
                            'role_id'=> $role->id,
                            'permission_id' => $permission->id,
                            'created_at' => now(),
                        ]);
                    }
                    break;

                case 'system-tester':
                    $modules = ['dashboard', 'visitors', 'deliveries'];

                    foreach ($modules as $module_key => $module) {
                        $permissions = \App\Models\Permissions::where('module', $module)->get();

                        foreach ($permissions as $permission_key => $permission) {

                            $role_has_permissions =  DB::table('role_has_permissions')->insert([
                                'role_id'=> $role->id,
                                'permission_id' => $permission->id,
                                'created_at' => now(),
                            ]);
                        }
                    }
                    break;

                    case 'unit-owner':
                        $modules = ['dashboard', 'visitors', 'deliveries'];
    
                        foreach ($modules as $module_key => $module) {
                            $permissions = \App\Models\Permissions::where('module', $module)->get();
    
                            foreach ($permissions as $permission_key => $permission) {
    
                                $role_has_permissions =  DB::table('role_has_permissions')->insert([
                                    'role_id'=> $role->id,
                                    'permission_id' => $permission->id,
                                    'created_at' => now(),
                                ]);
                            }
                        }
                        break;

                    case 'guard':
                        $modules = ['dashboard', 'visitors', 'deliveries'];
    
                        foreach ($modules as $module_key => $module) {
                            $permissions = \App\Models\Permissions::where('module', $module)->get();
    
                            foreach ($permissions as $permission_key => $permission) {
    
                                $role_has_permissions =  DB::table('role_has_permissions')->insert([
                                    'role_id'=> $role->id,
                                    'permission_id' => $permission->id,
                                    'created_at' => now(),
                                ]);
                            }
                        }
                        break;
                
                default:
                    # code...
                    break;
            }
        }
    }
}
