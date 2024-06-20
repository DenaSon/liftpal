<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Invoice extends Model
{
    use HasFactory;
    // Define the relationship: An invoice belongs to a single order
    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'transactionable');
    }

    // Define the payments relationship (one-to-many)
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }


}
