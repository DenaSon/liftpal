<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Wallet extends Model
{
    use HasFactory;


    // Define the user relationship ( one-to-one)
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define the transactions relationship (polymorphic one-to-many)
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    // Define the payments relationship (polymorphic one-to-many)
    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }


}
