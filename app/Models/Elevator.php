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

    public function isActive(): bool
    {
        return $this->type === 'active';
    }
    public function isUnderMaintenance(): bool
    {
        return $this->type === 'maintenance';
    }
    public function isPassenger(): bool
    {
        return $this->type === 'passenger';
    }

    public function isFreight(): bool
    {
        return $this->type === 'freight';
    }

    public function isService(): bool
    {
        return $this->type === 'service';
    }

    public function isPanoramic(): bool
    {
        return $this->type === 'panoramic';
    }

    public function isOther(): bool
    {
        return $this->type === 'other';
    }
}
