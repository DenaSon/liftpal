<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Category extends Model
{

    public $fillable = ['name','type','parent_id'];

    // Many-to-many relationship with products
    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }

    // Many-to-many relationship with posts
    public function posts() : BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }

    public function coupons() : MorphToMany
    {
        return $this->morphToMany(Coupon::class, 'couponable');
    }




    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }







}
