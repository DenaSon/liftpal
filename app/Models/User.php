<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


 class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;


     /**
      * The attributes that are mass assignable.
      *
      * @var array<int, string>
      */
     protected $fillable = [
         'name',
         'email',
         'phone',
         'password',
         'email_verified_at',
         'phone_verified_at',
         'status',
         'role'
     ];

     /**
      * Determine if the user's phone number has been verified.
      *
      * @return bool
      */
     public function hasVerifiedPhone(): bool
     {
         return !is_null($this->phone_verified_at);
     }

     public function favorites()
     {
         return $this->hasMany(Favorite::class);
     }

     /**
      * Mark the user's phone number as verified.
      *
      * @return void
      */
     public function markPhoneAsVerified() : void
     {
         $this->phone_verified_at = now();
         $this->save();
     }


     /**
      * Mark the user's role  as doctor.
      *
      * @return void
      */
     public function markRoleAsCustomer(): void
     {
         $this->role = 'customer';
         $this->save();
     }
     /**
      * Mark the user's role  as doctor.
      *
      * @return void
      */
     public function markEmailAsUnverified(): void
     {
         $this->email_verified_at = null;
         $this->save();
     }


     /**
      * Check User Role
      * String $role
      */
     public function isRole(string $role): bool
     {

         if ($this->role == $role)
         {
             return true;
         }
         return false;

     }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


     public function images() : MorphToMany
     {
         return $this->morphToMany(Image::class, 'imageable');
     }

    // Define the relationship: Each user has one profile
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

     // Define the relationship: Each user has one Wallet
     public function wallet(): HasOne
     {
         return $this->hasOne(Wallet::class);
     }


    public function comments() :HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public  function logs(): HasMany
    {
        return $this->hasMany(Log::class);
    }


    /**
     * Define the relationship between User and Notify models.
     * @return HasMany
     */
    public function notifies() :  HasMany
    {
        return $this->hasMany(Notify::class, 'user_id');
    }

    /**
     * Define the relationship between User and Invoice models.
     * @return HasMany
     */
    public function invoices() : HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Define the relationship between User and Coupons models.
     * @return MorphToMany
     */

    public function coupons() : MorphToMany
    {
        return $this->morphToMany(Coupon::class, 'couponable');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);

    }

        // Define the tickets relationship (one-to-many)
        public function tickets(): HasMany
    {

        return $this->hasMany(Ticket::class);

    }

        // Define the responses relationship (one-to-many)
        public function responses(): HasMany
        {
        return $this->hasMany(Response::class);
    }

    // Define the reviews relationship (one-to-many)
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Define the payments relationship (one-to-many)
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

     // Define the blog posts relationship ( OneToMane )
     public function posts(): HasMany
     {
         return $this->hasMany(Post::class);
     }

     public function addresses(): HasMany
     {
        return $this->hasMany(Address::class);
     }

     public function accounts(): HasMany
     {
         return $this->hasMany(Financial::class);
     }
     public function skills(): BelongsToMany
     {
         return $this->belongsToMany(Skill::class);
     }


}
