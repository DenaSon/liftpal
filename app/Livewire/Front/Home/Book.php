<?php

namespace App\Livewire\Front\Home;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Book extends Component
{
    use LivewireAlert;
    public $products= [];

    public function mount()
    {
        $this->products = Product::all();

    }



    public function addFavorite($productId, $checked)
    {

        if (auth()->check())
        {
            $userId = auth()->user()->id;
            $existingFavorite = Favorite::where('user_id', $userId)->where('product_id', $productId)->first();
            if ($checked && !$existingFavorite)
            {
                $favorite = new Favorite();
                $favorite->user_id = $userId;
                $favorite->product_id = $productId;
                $favorite->save();
            }
            elseif (!$checked && $existingFavorite)
            {
                $existingFavorite->delete();
            }
        }
        else
        {
            $this->alert('warning','برای افزودن به علاقمندی ابتدا وارد حساب کاربری خود شوید.');
        }
    }
        public function addCart($productId, $typeId)
        {


            $authId = auth()->id();
            $isLoggedIn = auth()->check();

            if (!$isLoggedIn)
            {
                $this->flash('info', 'لطفا ابتدا وارد حساب کاربری خود شوید');
                $this->redirectRoute('register', navigate: true);
            }
            else
            {
                $existingCart = Cart::where('user_id', $authId)
                                    ->where('product_id', $productId)
                                    ->where('type_id', $typeId)
                                    ->exists();

                if ($existingCart)
                {
                    $this->alert('warning', 'این مورد در سبد خرید شما قرار دارد.');

                }
                else
                {
                    $cart = new Cart();
                    $cart->user_id = $authId;
                    $cart->product_id = $productId;
                    $cart->type_id = $typeId;
                    $cart->quantity = 1;
                    $cart->save();
                    $this->alert('success', 'کتاب به سبد خرید شما افزوده شد');
                }
            }
        }

        public function removeCart($productId, $typeId)
        {

            $authId = auth()->id();
           Cart::where('user_id', $authId)
                ->where('product_id', $productId)
                ->where('type_id', $typeId)
                ->delete();


        }





    public function render()
    {
        return view('livewire.front.home.book');
    }
}
