<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class History extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'histories';
    protected $fillable = ['user_id', 'product_id', 'order_id', 'type_id', 'quantity', 'price', 'discount_amount', 'product_name', 'type_name'];


    public function order() {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }


}
