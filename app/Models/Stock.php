<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Stock extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }



    public function supplier() : BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }


}
