<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('testimonianls')->insert([
            ['id' => '3', 'name' => 'Bambang', 'quote' => 'Layanan iWash sangat memuaskan!'],
            ['id' => '4','name' => 'Yanto', 'quote' => 'Proses cepat dan hasil cucian bersih.']
        ]);
    }
}
