<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Building extends Model
{
    use HasFactory;

    public function technician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'technician_id');
    }




    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
