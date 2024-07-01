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
    public $sended;
    public $delivered;
    public $return;
    use withPagination, WithoutUrlPagination;


    public function getSended()
    {
        $this->resetPage();
        $this->return = false;
        $this->delivered = false;
        return $this->sended = true;

    }

    public function getDelivered()
    {
        $this->resetPage();
        $this->sended = false;
        $this->return = false;
        $this->delivered = true;
    }

    public function getReturn()
    {
        $this->resetPage();
        $this->sended = false;
        $this->delivered = false;
        $this->return = true;
    }



    public function render()
    {
        $authUser = auth()->user();
        $orders = Order::query();

        if ($this->sended) {
            $orders->whereStatus('shipped');
        } elseif ($this->delivered) {
            $orders->whereStatus('delivered');
        } elseif ($this->return) {
            $orders->whereStatus('return');

        }

        $orders = $orders->whereUserId(auth()->id())->paginate(10);

        return view('livewire.front.panel.components.main', ['orders' => $orders]);
    }

}
