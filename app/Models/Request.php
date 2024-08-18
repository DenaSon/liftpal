<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Request extends Model
{

    protected $fillable = [
        'building_id',
        'technician_id',
        'status',
        'description'
    ];

    public function getStatus()
    {
        switch ($this->status) {
            case 'pending':
                return 'در انتظار';
                break;
            case  'expired' :
                return 'منقضی شده';
            case 'accepted':
                return 'پذیرفته شده';
            case 'rejected' :
                'رد شده';
            case 'unknown':
                return 'نامشخص';
                break;
            default :
                  return 'نامشخص';
        }
    }

    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class);
    }
    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }
    public function company(): HasOneThrough
    {
        return $this->hasOneThrough(
            Company::class,
            Profile::class,
            'user_id',         // کلید خارجی در جدول profiles که به جدول users اشاره دارد
            'id',              // کلید اصلی در جدول companies
            'technician_id',   // کلید خارجی در جدول requests که به جدول profiles اشاره دارد
            'company_id'       // کلید خارجی در جدول profiles که به جدول companies اشاره دارد
        );
    }

}
