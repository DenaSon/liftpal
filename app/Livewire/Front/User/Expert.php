<?php

namespace App\Livewire\Front\User;

use App\Models\User;
use Illuminate\Support\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Expert extends Component
{
    public $user = null;
    public $passedDays;
    use LivewireAlert;

    public function mount($id, $name='')
    {
        $this->user = User::with('profile', 'comments','skills','addresses','images')
            ->whereRole('technician')
            ->findOrFail($id);

        //Calculate passed date
        $createdAt = new Carbon($this->user->created_at);
        $currentDate = Carbon::now();
        $this->passedDays = $currentDate->diffInDays($createdAt);
    }


    public function render()
    {
        $username = $this->user->profile->name . ' ' . $this->user->profile->last_name;
        $address = $this->user?->addresses->first()?->province ;
        if($address)
        {
            $addressStr = ' در ' . $address;
        }
        else
        {
            $addressStr = '';
        }


        $text = 'کارشناس فنی';



        return view('livewire.front.user.expert')->title($username . ' ' . $text .' '.$addressStr );
    }
}
