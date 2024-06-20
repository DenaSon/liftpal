<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    use HasFactory;

    // Define the user relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define the responses relationship
    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }
}
