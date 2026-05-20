<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['room_number', 'type', 'price_per_night', 'capacity', 'status', 'description'])]
class Room extends Model
{
<<<<<<< HEAD
    protected $fillable = [
    'room_number',
    'type',
    'price_per_night',
    'capacity',
    'status',
    'description',
];

    public function reservations()
    {
=======
    public function reservations() {
>>>>>>> AI-Integration
        return $this->hasMany(Reservation::class);
    }
}
