<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory;
    public $guarded =[];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the parent commentable model (post or product).
     */
    public function commentable()
    {
        return $this->morphTo();
    }
}
