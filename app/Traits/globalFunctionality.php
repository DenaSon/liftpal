<?php

namespace App\Traits;

trait globalFunctionality
{
    protected $authUserId = '';
    protected $authUser = [];

    public function __construct()
    {
        $this->authUserId = \Auth::id();
        $this->authUser = \Auth::user();
    }


}



