<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{


    public $fillable = ['id','name','type'];

    // Many-to-many relationship with products
    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }

    //Average of Tag Views

    public static  function averageViews()
    {
        return static::avg('views');

    }


    // Many-to-many relationship with posts
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }
}
