<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_default',
        'province',
        'city',
        'postal_address',
        'postal_code',
        'building_number',
        'unit_number',
        'recipient_name',
        'recipient_family',
    ];

    public function user()
    {
      return  $this->belongsTo(User::class);
    }

    public function profile()
    {
        return  $this->belongsTo(Profile::class,'user_id');
    }

    public function order()
    {
        return    $this->belongsTo(Order::class,'user_id');
    }


}
