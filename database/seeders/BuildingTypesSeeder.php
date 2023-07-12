<?php

namespace Database\Seeders;

use App\Models\BuildingTypes;
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
        $buildingType = BuildingTypes::firstOrCreate(
            ['name' => 'HOA/Condo Corp.'],
            [
                'delivery_form' => true,
                'status' => true,
                'created_at' => date('Y-m-d h:i:s')
            ]
        );
    }
}
