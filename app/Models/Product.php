<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class Product extends Model
{
    use HasFactory;


    protected $fillable = [
        'brand_id',
        'sku',
        'name',
        'details',
        'description',
        'is_featured',
        'is_active',
        'dimensions',
        'additional_info',
    ];

    public function properties(): BelongsToMany
    {
        return $this->belongsToMany(Property::class, 'property_propertyvalue_product', 'product_id', 'propertyvalue_id');
    }


    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id');
    }


    public function propertyValues(): BelongsToMany
    {
        return $this->belongsToMany(PropertyValue::class, 'property_propertyvalue_product');
    }


   public function getPropertyValues()
    {
     return Propertyvalue::join('property_propertyvalue_product', 'propertyvalues.id', '=', 'property_propertyvalue_product.propertyvalue_id')
         ->join('properties', 'propertyvalues.property_id', '=', 'properties.id')
         ->where('property_propertyvalue_product.product_id', $this->id)
         ->select('properties.name as name', 'propertyvalues.value as value')
         ->get();

    }

    public function scopeProductProperties($query, $productId)
    {
        return $query->join('property_propertyvalue_product', 'products.id', '=', 'property_propertyvalue_product.product_id')
            ->join('propertyvalues', 'property_propertyvalue_product.propertyvalue_id', '=', 'propertyvalues.id')
            ->join('properties', 'propertyvalues.property_id', '=', 'properties.id')
            ->where('products.id', $productId)
            ->select('properties.name as name', 'propertyvalues.value as value')->get();
    }



    public function types() : HasMany
    {
        return $this->hasMany(Type::class);
    }


    public function type()
    {
        return $this->hasOne(Type::class);
    }


    // Define the relationship: One product has many batches
    public function batches() : HasMany
    {
        return $this->hasMany(Batch::class);
    }

    // Define the relationship: Each product belongs to a brand
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    // Many-to-many relationship with tags
    public function tags() :BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    // Many-to-many relationship with categories
    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    /**
     * Get all of the product's comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    /**
     * Get the images associated with the product.
     *
     * @return MorphToMany
     */
    public function images() : MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
    /**
     * Get the coupons associated with the product.
     *
     * @return MorphToMany
     */

    public function coupons() : MorphToMany
    {
        return $this->morphToMany(Coupon::class, 'couponable');
    }


    public function history()
    {
        return $this->hasMany(History::class, 'product_id');
    }


    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }



    // Define the reviews relationship (one-to-many)
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
    /**
     * Get the PriceDetails associated with the product.
     *
     * @return HasOne
     */

    //Define Scopes

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeStopSell($query)
    {
        return $query->where('stop_sell', true);
    }


}

