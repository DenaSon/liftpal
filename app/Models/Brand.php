<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Brand extends Model
{
    use HasFactory;

    public $guarded =[];

    // Define the relationship: Each brand has many products
    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the images associated with the brand.
     *
     * @return MorphToMany
     */
    public function images() :MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

}
