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
        $outletData = [
            [
                'name' => 'iWash Main Pos 1',
                'opening_time' => '08:00:00',
                'closing_time' => '16:00:00',
            ],
            [
                'name' => 'iWash Main Pos 2',
                'opening_time' => '08:00:00',
                'closing_time' => '16:00:00',
            ]
        ];
        foreach ($outletData as $key => $val) {
            Outlet::create($val);
        }
    }
}
