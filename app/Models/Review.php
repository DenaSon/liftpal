<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'title',
        'content',
        'is_approved',
    ];

    // Define the user relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Define the product relationship
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
