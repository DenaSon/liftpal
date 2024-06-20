<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    use HasFactory;

    // Define the ticket relationship
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    // Define the user relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
