<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optimization extends Model
{
    use HasFactory;
    public $table = 'optimizations';
    protected $fillable = ['key','value'];

}
