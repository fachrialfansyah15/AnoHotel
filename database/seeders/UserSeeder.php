<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'AnoHotel Admin',    'role' => 'admin'],
            ['name' => 'AnoHotel Manajer',  'role' => 'manajer'],
            ['name' => 'AnoHotel Receptionist',    'role' => 'receptionist'],
            ['name' => 'AnoHotel Housekeeping',   'role' => 'housekeeping'],
            ['name' => 'Guest',    'role' => 'guest'],
        ];

        foreach ($users as $i => $u) {
            User::create([
                'name'     => $u['name'],
                'email'    => strtolower($u['role']) . '@anohotel.com',
                'password' => bcrypt('password123'),
                'role'     => $u['role'],
            ]);
        }
    }
}


