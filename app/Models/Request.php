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
               return 'رد شده';
               break;
            case 'cancelled' :
                return 'لغو شده';
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
    public function company()
    {
        return $this->building()->companies;
     }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
