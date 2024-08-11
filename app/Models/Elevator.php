<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elevator extends Model
{
    protected $fillable = [
        'user_id',
        'building_id',
        'model',
        'capacity',
        'type',
        'manufacturer',
        'last_inspection_date',
        'installation_date',
        'status',
        'last_maintenance_date',
        'next_maintenance_date',
    ];


    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Building::class, 'id', 'id', 'building_id', 'user_id');
    }

    public function getType($type)
    {
        switch ($type) {
            case 'passenger':
                return 'مسافربر';
            case 'freight':
                return 'باربر';
            case 'service':
                return 'خدماتی';
            case 'hospital':
                return 'بیمارستانی';
            case 'panoramic':
                return 'پانورامیک';
            case 'dumbwaiter':
                return 'دمبویتر';
            case 'home':
                return 'خانگی';
            case 'vehicle':
                return 'خودروبر';
            case 'other':
                return 'سایر';
            default:
                return 'نامشخص'; // If the type doesn't match any case
        }
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
