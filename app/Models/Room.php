<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['room_number', 'type', 'price_per_night', 'capacity', 'status', 'description'])]
class Room extends Model
{
    protected $fillable = [
        'type',
        'price',
        'status'
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}