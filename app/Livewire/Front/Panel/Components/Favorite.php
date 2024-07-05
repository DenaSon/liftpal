<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\Product;
use App\Traits\globalFunctionality;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Lazy;
use Livewire\Component;


#[Lazy]
class Favorite extends Component
{

    use globalFunctionality, LivewireAlert;

    protected $listeners = ['doRemoveAddFavorites'];

    public function confirmDelete()
    {
        $this->confirm('همه موارد حذف شوند؟', [
            'onConfirmed' => 'doRemoveAddFavorites',
        ]);
    }

    public function doRemoveAddFavorites(): void
    {
        logger('doRemoveAddFavorites called');

        $favorites = \App\Models\Favorite::whereUserId($this->authUserId)->delete();
        $this->alert('success', 'همه موارد حذف شدند');

    }



    public $products;
    public function render()
    {
        $authId = Auth::id();

        // Get the favorite product IDs for the authenticated user
        $favoriteProductIds = \App\Models\Favorite::where('user_id', $authId)->pluck('product_id');

        // Retrieve the products with those IDs
        $this->products = Product::whereIn('id', $favoriteProductIds)
            ->take(15)
            ->get();

        return view('livewire.front.panel.components.favorite', ['products' => $this->products]);
    }
}
