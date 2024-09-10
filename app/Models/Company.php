<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{





    protected $fillable = [
        'manager_national_code',
        'name',                // Company name
        'licence_code',
        'telephone',
        'national_id',         // National ID
        'economic_code',       // Economic code
        'registration_code',   // Registration code
        'license_expiration_date',      // Licence expiry date
        'province',            // Province
        'address',             // Address
        'user_id',              // User ID (associated with the authenticated user)
        'email',
        'active'
    ];


    public function buildings()
    {
        return $this->belongsToMany(Building::class, 'building_company', 'company_id', 'building_id');
    }


    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function technicians(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'technician_company', 'company_id', 'user_id');
    }




}
