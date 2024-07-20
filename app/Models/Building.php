<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'technician_id',
        'manager_name',
        'manager_contact',
        'emergency_contact',
        'builder_name',
        'floors',
        'units',
        'address',
    ];


    public function elevators(): HasMany
    {
        return $this->hasMany(Elevator::class);
    }


}
