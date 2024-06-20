<?php

namespace App\Livewire\Front\Shop\Single;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Support\Facades\Crypt;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SingleProduct extends Component
{
    use LivewireAlert;

    #[Locked]
    #[Validate('exists:products,id,numeric')]
    public $id;
    #[Locked]
    public $product;
    public $check_favorite;
    #[Locked]
    public $productId;
    public $carts;

    public $selectedType = [];


    public function addSingleCart($productId)
    {
        $this->productId = Crypt::decrypt($productId);

        $typeId = Type::whereProductId($this->productId)->value('id');
        if (auth()->check())
        {
            if(Cart::firstOrCreate(['user_id' => auth()->id(), 'product_id' => $this->productId, 'type_id' => $typeId, 'quantity' => 1]))
            {
                $this->alert('info','محصول به سبد خرید افزوده شد');
            }
            else
            {
                $this->alert('info','محصول در سبد خرید شما وجود دارد');
            }

        }

    }

    public function addTypeCart($productId)
    {
        $this->productId = Crypt::decrypt($productId);

        $existType = Cart::whereProductId($this->productId)->whereTypeId($this->selectedType)->first();
        if (auth()->check()) {

            if (!empty($this->selectedType)) {


                if (!$existType) {
                    Cart::firstOrCreate([
                        'type_id' => $this->selectedType,
                        'product_id' => $this->productId,
                        'user_id' => auth()->user()->id,
                        'quantity' => 1
                    ]);
                    $this->dispatch('added-cart');
                    $this->alert('info','محصول به سبد خرید افزوده شد');
                } else {
                    $this->alert('info', 'محصول در سبد خرید شما قرار دارد', ['position' => 'center']);
                }


            } else {
                $this->alert('warning', 'یکی از انواع محصول را انتخاب کنید');
            }

        }
    }


    public function removeSingleCart($productId)
    {
        $this->productId = Crypt::decrypt($productId);

        $typeId = Type::whereProductId($this->productId)->value('id');
        if (auth()->check()) {
            Cart::whereUserId(auth()->user()->id)->whereProductId($this->productId)->whereTypeId($typeId)->delete();
            $this->alert('info', 'محصول از سبد خرید شما حذف  شد');
        } else {

        }
    }

    public function add_favorite()
    {
        if (!auth()->check())
            $this->alert('info', 'لطفا وارد حساب کاربری خود شوید');
        $auth_id = auth()->id();

        $exist_product = Favorite::where('user_id', $auth_id)->where('product_id', $this->id)->first();
        if ($exist_product) {
            Favorite::where('user_id', $auth_id)->where('product_id', $this->id)->delete();

        } else {
            Favorite::create(['user_id' => $auth_id, 'product_id' => $this->id]);
            $this->alert('info', 'محصول به لیست نشان شده ها افزوده شد');
        }


    }

    public function mount($id)
    {
        if (!is_numeric($id)) {
            abort(404);
        }

        $this->product = Product::with(['categories', 'comments', 'types'])->find($id);

        if (!$this->product) {
            abort(404);
        }

        $this->increaseView($this->product);
    }

    private function increaseView($product)
    {
        $productKey = 'product_' . $product->id;

        if (!session($productKey)) {
            $product->views++;
            $product->save();

            session([$productKey => true]);

        }
    }

    public function render()
    {

        return view('livewire.front.shop.single.single-product', ['product' => $this->product])->title($this->product->name ?? '404');
    }
}
