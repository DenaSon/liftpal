<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\Order;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Invoice extends Component
{
    use LivewireAlert;
    public $order = [];

    public function mount()
    {


        $authUserId = auth()->user()->id;
        $orderId = request()->input('order');

        if (!is_numeric($orderId)) {
            abort(400, 'Invalid order ID');
        }

        $this->order = Order::whereUserId($authUserId)->whereOrderNumber($orderId)->first();

        if (!$this->order) {
            abort(404);
        }

    }
    public function render()
    {
        return view('livewire.front.panel.components.invoice');
    }
}
