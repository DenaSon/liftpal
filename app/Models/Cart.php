<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','product_id','type_id','quantity','status'];
    public $table = 'carts';


    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class, 'type_id', 'type_id');
    }



}
