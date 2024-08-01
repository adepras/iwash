<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Outlet::create([
            'name' => 'iWash Main Slot 1',
            'opening_time' => '08:00:00',
            'closing_time' => '16:00:00',
        ]);
    }
}
