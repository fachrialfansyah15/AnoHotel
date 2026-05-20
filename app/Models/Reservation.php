<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
<<<<<<< HEAD
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
=======
    public function user() {
        return $this->belongsTo(User::class);
    }
>>>>>>> AI-Integration

    public function room() {
        return $this->belongsTo(Room::class);
    }

<<<<<<< HEAD
    /*
    |--------------------------------------------------------------------------
    | RELATION : PAYMENT
    |--------------------------------------------------------------------------
    */

    public function payment()
    {
=======
    public function payment() {
>>>>>>> AI-Integration
        return $this->hasOne(Payment::class);
    }
}
