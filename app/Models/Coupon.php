<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Coupon extends Model
{
    use HasFactory;


    public function categories() : MorphToMany
    {
        return $this->morphedByMany(Category::class, 'couponable');
    }

    public function products() : MorphToMany
    {
        return $this->morphedByMany(Product::class, 'couponable');
    }

    public function users() : MorphToMany
    {
        return $this->morphedByMany(User::class, 'couponable');
    }

    public function productDetail(): MorphToMany
    {
        return $this->morphedByMany(ProductDetail::class, 'couponable');
    }



}
