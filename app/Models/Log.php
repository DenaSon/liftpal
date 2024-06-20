<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Log extends Model
{
    use Notifiable;

   public function user():BelongsTo
   {
       return $this->belongsTo(User::class);

   }

    public function profile():BelongsTo
    {
        return $this->belongsTo(Profile::class,'user_id');

    }


}
