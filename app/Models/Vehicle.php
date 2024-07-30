<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vehicle_brand',
        'vehicle_type',
        'license_plate',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function hasActiveBooking()
    {
        return $this->bookings()->where('status', '!=', 'finished')->exists();
    }
}
