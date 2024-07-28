<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'booking_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//     protected $fillable = [
//         'user_id',
//         'name',
//         'phone',
//         'vehicle_brand',
//         'vehicle_type',
//         'license_plate',
//         'booking_date',
//     ];
}
