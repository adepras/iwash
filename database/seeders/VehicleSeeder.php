<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'user_id' => 1,
                'vehicle_brand' => 'Toyota',
                'vehicle_type' => 'GR Corrola',
                'license_plate' => 'B 1234 ABC',
            ],
            [
                'user_id' => 1,
                'vehicle_brand' => 'Honda',
                'vehicle_type' => 'Jazz',
                'license_plate' => 'B 5678 ABC',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            \App\Models\Vehicle::create($vehicle);
        }
    }
}
