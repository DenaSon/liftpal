<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\Order;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

#[Lazy]
class Main extends Component
{
    use withPagination, WithoutUrlPagination;


    public function render()
    {
        $authUser = auth()->user();
        $orders = Order::whereUserId($authUser->id)->latest()->paginate(10);
        return view('livewire.front.panel.components.main', ['orders' => $orders]);
    }

}
