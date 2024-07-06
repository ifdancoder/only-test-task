<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function model() {
        return $this->belongsTo(CarModel::class, 'model_id');
    }
     
    public function driver() {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function bookings() {
        return $this->hasMany(CarBooking::class);
    }

    public function isAvailable($startDatetime, $endDatetime) {
        $bookings = $this->bookings()->whereBetween('start_datetime', [$startDatetime, $endDatetime])->whereBetween('end_datetime', [$startDatetime, $endDatetime])->get();
        return $bookings->count() == 0;
    }
}
