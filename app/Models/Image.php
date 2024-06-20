<?php

namespace App\Models;

use App\Http\Controllers\Admin\Global\SliderController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    use HasFactory;
    public  $fillable = ['id','album_id','file_name','file_path','is_index','link'];


    /**
     * Get all of the posts that are assigned this image.
     */
    public function posts(): MorphToMany
    {
        return $this->morphedByMany(Post::class, 'imageable');
    }

    /**
     * Get all of the products that are assigned this image.
     */
    public function products(): MorphToMany
    {
        return $this->morphedByMany(Product::class, 'imageable');
    }
    /**
     * Get all of the Slider Model that are assigned this image.
     */
    public function sliders(): MorphToMany
    {
        return $this->morphedByMany(Slider::class, 'imageable');
    }

    /**
     * Get all of the products that are assigned this image.
     */
    public function brands(): MorphToMany
    {
        return $this->morphedByMany(Brand::class, 'imageable');
    }

    /**
     * Get all of the profiles that are assigned this image.
     */
    public function profile(): MorphToMany
    {
        return $this->morphedByMany(Profile::class, 'imageable');
    }



    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

}
