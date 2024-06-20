<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Profile extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Define the relationship: Each profile belongs to one user
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the images associated with the profile.
     *
     * @return MorphToMany
     */
    public function images() : MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }




}
