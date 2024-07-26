<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Ade Prasetyo',
                'phone_number' => '081212341234',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('akunuser1'),
                'address' => 'Kab.Purworejo',
                'gender' => 'male',
                'role' => 'user'
            ],
            [
                'name' => 'Azyumi Azra',
                'phone_number' => '081212341234',
                'email' => 'admin1@gmail.com',
                'password' => bcrypt('akunadmin1'),
                'address' => 'Kab.Kudus',
                'gender' => 'female',
                'role' => 'admin'
            ],
            // [
            //     'name' => 'Admin Iwash',
            //     'phone_number' => '081219999204',
            //     'email' => 'iwashadmin@gmail.com',
            //     'address' => 'Desa Wirun, Kec.Kutoarjo, Kab.Purworejo, Jawa Tengah',
            //     'password' => bcrypt('adminiwash1234'),
            //     'gender' => 'male',
            //     'role' => 'admin'
            // ],
            // [
            //     'name' => '',
            //     'phone_number' => '',
            //     'email' => '',
            //     'address' => '',
            //     'password' => bcrypt(''),
            //     'gender' => '',
            //     'role' => ''
            // ],
        ];
        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
