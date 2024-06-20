<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class PostTag extends Model
{
    use HasFactory;

    /**
     * Get the images associated with the brand.
     *
     * @return MorphToMany
     */
    public function images() : MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

}
