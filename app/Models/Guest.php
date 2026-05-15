<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'phone', 'id_card_number', 'address'])]
class Guest extends Model
{
    protected $table = 'guest';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
