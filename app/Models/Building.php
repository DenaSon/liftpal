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

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    public function technicians()
    {
        return $this->belongsToMany(User::class, 'building_technician')
            ->withPivot('company_id')
            ->withTimestamps()
            ->as('technician')
            ->where('role', 'technician');
    }




    public function companies()
    {
        return $this->belongsToMany(Company::class, 'building_technician', 'building_id', 'company_id')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
