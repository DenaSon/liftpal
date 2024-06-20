<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Slider extends Model
{
    use HasFactory;

    public function images() : MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');
    }


}
