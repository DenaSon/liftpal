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
        return $this->hasMany(Profile::class, 'company_id')
            ->whereHas('user', function($query) {
                $query->where('role', 'technician');
            });
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

}
