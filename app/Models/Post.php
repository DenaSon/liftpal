<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];




    // Many-to-many relationship with tags
    public function tags() : BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    // Many-to-many relationship with categories
    public function categories() : BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    /**
     * Get all of the post's comments.
     */
    public function comments() : MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get the images associated with the post.
     *
     * @return MorphToMany
     */
    public function images() : MorphToMany
    {
        return $this->morphToMany(Image::class, 'imageable');

    }

    /**
     * Get the user associated with the post.
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);

    }

    public function profile()
    {
        return $this->belongsTo(Profile::class,'user_id');
    }





}
