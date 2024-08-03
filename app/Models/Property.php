<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

    public $guarded =[];

    public function propertyvalues()
    {
        return $this->hasMany(Propertyvalue::class, 'property_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'property_propertyvalue_product');
    }

}
