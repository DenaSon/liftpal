<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'status', 'total_price', 'payment_status', 'payment_method',
        'shipping_address', 'billing_address', 'order_number', 'customer_notes',
        'shipping_method', 'shipping_cost', 'tax', 'discount_amount',
        'discount_code', 'subtotal', 'grand_total', 'currency', 'payment_due_date',
        'payment_transaction_id'
    ];






    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class,'user_id','user_id');
    }



    // Define the relationship: An order can have one invoice
    public function invoice() : HasOne
    {
        return $this->hasOne(Invoice::class);
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }




    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'order_id');
    }


    public function history() {
        return $this->hasMany(History::class, 'order_id');
    }


    public function paid()
    {
        if($this->where('payment_status','paid'))
        {
            return true;
        }
        return  false;
    }


}
