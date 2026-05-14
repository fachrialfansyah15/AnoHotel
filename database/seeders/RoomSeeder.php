<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = [
            ['room_number' => '101', 'type' => 'standard', 'price_per_night' => 350000, 'capacity' => 2],
            ['room_number' => '102', 'type' => 'standard', 'price_per_night' => 350000, 'capacity' => 2],
            ['room_number' => '201', 'type' => 'deluxe',   'price_per_night' => 600000, 'capacity' => 3],
            ['room_number' => '202', 'type' => 'deluxe',   'price_per_night' => 600000, 'capacity' => 3],
            ['room_number' => '301', 'type' => 'suite',    'price_per_night' => 1200000,'capacity' => 4],
        ];

        foreach ($rooms as $room) {
            Room::create(array_merge($room, ['status' => 'available']));
        }
    }
}
