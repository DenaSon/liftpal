<?php

namespace App\Observers;

use App\Models\company;
use App\Models\Message;

class companyObserver
{
    /**
     * Handle the company "created" event.
     */
    public function created(company $company): void
    {
        //
    }

    /**
     * Handle the company "updated" event.
     */
    public function updated(company $company): void
    {



    }

    /**
     * Handle the company "deleted" event.
     */
    public function deleted(company $company): void
    {
        //
    }

    /**
     * Handle the company "restored" event.
     */
    public function restored(company $company): void
    {
        //
    }

    /**
     * Handle the company "force deleted" event.
     */
    public function forceDeleted(company $company): void
    {
        //
    }







}
