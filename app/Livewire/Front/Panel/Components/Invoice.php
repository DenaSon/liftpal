<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\History;
use App\Models\Order;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Invoice extends Component
{
    use LivewireAlert;
    public $order = [];
    public $orderCount;

    public function mount()
    {

        //Get Sum of Orders


        $authUserId = auth()->user()->id;
        $orderNumberId = request()->input('order');

        if (!is_numeric($orderNumberId)) {
            abort(400, 'Invalid order ID');
        }

        $this->order = Order::whereUserId($authUserId)->whereOrderNumber($orderNumberId)->first();

        if (!$this->order) {
            abort(404);
        }

        $orderId = $this->order->id;
        $this->orderCount = History::whereOrderId($orderId)?->sum('quantity') ?? 0;


    }
    public function render()
    {


        return view('livewire.front.panel.components.invoice');
    }
}
