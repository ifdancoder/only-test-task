<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComfortCategory extends Model
{
    use HasFactory;

    public function carModels() {
        return $this->hasMany(CarModel::class);
    }

    public function userPositions() {
        return $this->hasMany(UserPosition::class);
    }
}
