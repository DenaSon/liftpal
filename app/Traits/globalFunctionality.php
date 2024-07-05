<?php

namespace App\Traits;

trait globalFunctionality
{
    protected $authUserId = '';

    public function __construct()
    {
        return $this->authUserId = \Auth::id();
    }


}



