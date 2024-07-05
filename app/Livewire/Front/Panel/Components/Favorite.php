<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\Product;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class Favorite extends Component
{
    public $products;
    public function render()
    {
        $this->products = Product::with('favorites')->take(15)->get();
        return view('livewire.front.panel.components.favorite',['products' => $this->products]);
    }
}
