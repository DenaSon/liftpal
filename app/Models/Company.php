<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name',
        'manager_name',
        'manager_national_code',
        'national_id',
        'economic_code',
        'registration_code'
    ];

    public function technicians()
    {
        return $this->belongsToMany(User::class, 'building_technician')
            ->withPivot('building_id')
            ->withTimestamps();
    }


    public function requests()
    {
        return $this->hasManyThrough(
            Request::class,
            Profile::class,
            'company_id',
            'technician_id',
            'id',
            'user_id'
        );
    }


    public function buildings()
    {
        return $this->belongsToMany(Building::class, 'building_technician')
            ->withPivot('user_id')
            ->withTimestamps();
    }



}
