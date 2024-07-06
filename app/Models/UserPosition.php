<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPosition extends Model
{
    use HasFactory;

    public function users() {
        return $this->hasMany(User::class);
    }

    public function comfortCategories() {
        return $this->belongsToMany(ComfortCategory::class, 'user_positions_comfort_categories', 'user_position_id', 'comfort_category_id');
    }
}
