<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'queue_number',
        'service',
        'package',
        'price',
        'estimated',
        'booking_date',
        'user_id',
        'name',
        'phone_number',
        'vehicle_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function getFormattedQueueNumberAttribute()
    {
        return sprintf('%03d', $this->queue_number);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
