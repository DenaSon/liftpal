<?php

namespace App\Observers;


use App\Models\Profile;
use App\Models\User;
use App\Models\Wallet;
use App\Notifications\WelcomeEmail;
use Throwable;

class UserObserver
{
    /**
     * Handle the MyModel "created" event.
     *
     * @param User $user
     *
     */
    public function created(User $user)
    {
        try {


        // Logic to be executed after User is created
        //Create Wallet Record for Registered user
        $wallet = new Wallet();
        $wallet->user_id = $user->id;
        $wallet->balance = 0;
        $wallet->is_active = 1;
        $wallet->save();


        }
        catch(Throwable $e)
        {
            setLog('ProfileWallet-Create',$e->getMessage() . ' File' . $e->getFile() . ' Line : ' . $e->getLine(),'danger');
            return response()->json('Error', 500);
        }

    return false;

    }



}
