<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'room_id', 'check_in', 'check_out', 'total_guest', 'status', 'notes'])]
class Reservation extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }

    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
