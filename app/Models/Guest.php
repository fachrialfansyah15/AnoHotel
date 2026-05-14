<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }
}
