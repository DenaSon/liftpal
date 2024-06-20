<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Define the relationship: One supplier can have many stocks
    public function stocks() : HasMany
    {
        return $this->hasMany(Stock::class);
    }

    // Define the relationship: One supplier can have many batches
    public function batches() : HasMany
    {
        return $this->hasMany(Batch::class);
    }

}
