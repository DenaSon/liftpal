<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Batch extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the Product associated with the batches.
     *
     * @return BelongsTo
     */
    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    /**
     * Get the stock associated with the batches.
     *
     * @return BelongsTo
     */
    public function supplier() : BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function type() : BelongsTo
    {
        return $this->belongsTo(Type::class);
    }



    public function increaseSale($amount)
    {
        $this->increment('sales_number',$amount);
    }

    public function cart()
    {
        return $this->belongsTo(Batch::class,'type_id','type_id');
    }



}
