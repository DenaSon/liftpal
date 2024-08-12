<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
    protected $fillable = [
        'full_name',
        'unit',
        'phone',
        'role',
        'is_active',
        'building_id',
    ];
    public function getRole($role)
    {
        switch ($role) {

            case 'owner':
                return 'مالک';
            case 'tenant':
                return 'مستاجر';
            case 'manager':
                return 'مدیر';
            case 'other' :
                return 'سایز';
            default:
                return 'نامشخص';

        }

    }


    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }
}
