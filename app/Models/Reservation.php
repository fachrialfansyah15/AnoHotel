<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'room_id',
        'check_in',
        'check_out',
        'total_guest',
        'notes',
        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATION : USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION : ROOM
    |--------------------------------------------------------------------------
    */

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATION : PAYMENT
    |--------------------------------------------------------------------------
    */

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}