<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propertyvalue extends Model
{
    public $table = 'propertyvalues';
    use HasFactory;
    public $guarded =[];

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'property_propertyvalue_product');
    }
}
