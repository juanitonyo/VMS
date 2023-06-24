<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildingTypes = DB::table('building_types')->insert([
            'name' => 'HOA/Condo Corp.',
            'delivery_form' => true,
            'status' => true,
            'created_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
