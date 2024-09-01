<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingTechnician extends Model
{

    public $incrementing =  false;
    protected $keyType = 'array';
    protected $table = 'building_technician';

    // If your table has primary key columns other than 'id', specify them
    protected $primaryKey = ['building_id', 'user_id', 'company_id'];


    protected $fillable = ['building_id', 'user_id', 'company_id'];


    public function building()
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    // Define the relationship to the User model as a technician
    public function technician()
    {
        return $this->belongsTo(User::class, 'user_id'); // 'technician_id' is the foreign key
    }

    // Define the relationship to the Company model
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }



}
