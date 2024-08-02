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
                'name' => 'Ade',
                'phone_number' => '+6281234567890',
                'email' => 'akunuser1@gmail.com',
                'password' => bcrypt('akunuser1'),
                'address' => 'Kec.Kutoarjo, Kab.Purworejo',
                'gender' => 'male',
                'role' => 'user'
            ],
            [
                'name' => 'Pras',
                'phone_number' => '+6281234567890',
                'email' => 'akunuser2@gmail.com',
                'password' => bcrypt('akunuser2'),
                'address' => 'Kec.Kutoarjo, Kab.Purworejo',
                'gender' => 'male',
                'role' => 'user'
            ],
            [
                'name' => 'Setyo',
                'phone_number' => '+6281234567890',
                'email' => 'akunuser3@gmail.com',
                'password' => bcrypt('akunuser3'),
                'address' => 'Kec.Kutoarjo, Kab.Purworejo',
                'gender' => 'male',
                'role' => 'user'
            ],
            [
                'name' => 'Admin Iwash',
                'phone_number' => '081219999204',
                'email' => 'admin@gmail.com',
                'address' => 'Kec.Kutoarjo, Kab.Purworejo',
                'password' => bcrypt('admin#1234'),
                'gender' => 'male',
                'role' => 'admin'
            ],
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
