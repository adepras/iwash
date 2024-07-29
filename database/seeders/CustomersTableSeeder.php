<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create(['name' => 'Ade Prasetyo', 'email' => 'adeprasetyo06@gmail.com', 'phone' => '81326793922']);
        Customer::create(['name' => 'Azyumi Azra', 'email' => 'azyumiazraa@gmail.com', 'phone' => '81575359161']);
    }
}
