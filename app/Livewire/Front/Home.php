<?php
namespace App\Livewire\Front;


use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;


class Home extends Component
{
    use LivewireAlert;
    public $search = '';


    public function mount()
    {
        if (!empty(request()->input('action') && request()->input('action') == 'login')) {
            $this->dispatch('login-action');
        }
    }

    public function render()
    {
        $title = getSetting('website_title') ?? 'LiftPal';
        return view('livewire.front.home')->title($title);

    }
}
