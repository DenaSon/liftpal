<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Type extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'name', 'price', 'quantity'];
    public $timestamps = false;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class,'type_id');
    }

    public function scopeFindByProductId($query, $product_id)
    {
        return $query->where('product_id', $product_id)->get(['name', 'price']);
    }

    public function scopeGetPriceByProductAndName($query, $productId, $typeName)
    {
        return $query->where('product_id', $productId)
            ->where('name', $typeName)
            ->value('price');
    }


}
