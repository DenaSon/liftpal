<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elevator extends Model
{
    use HasFactory;

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Building::class, 'id', 'id', 'building_id', 'user_id');
    }
}
