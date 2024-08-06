<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'date',
        'start_time',
        'end_time',
        'booked',
        'booking_id',
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
