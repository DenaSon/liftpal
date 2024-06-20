<?php

namespace App\Policies\Admin;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }
}
