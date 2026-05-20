<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['reservation_id', 'amount', 'method', 'status', 'paid_at'])]
class Payment extends Model
{
    protected $fillable = [
        'reservation_id',
        'amount',
        'payment_method',
        'status'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
