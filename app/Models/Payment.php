<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Payment extends Model
{
    use HasFactory;


    public function transaction() : MorphOne
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }


    // Define the user relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define the invoice relationship
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);

    }

    public function transactions(): MorphOne
    {
        return $this->morphOne(Transaction::class, 'transactionable');
    }

    // Define the wallet relationship (one-to-one)
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }


}
