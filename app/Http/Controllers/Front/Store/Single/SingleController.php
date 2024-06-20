<?php

namespace App\Http\Controllers\Front\Store\Single;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SingleController extends Controller
{
    public function single(Product $product)
    {



      if (count($product->types) != 0 && $product->is_active == 1)
      {
          $this->increaseView($product);
          $firstPrice = $product->types->first()->price -  ($product->type->first()->price  * $product->discount / 100) ?? 0;
          $firstPrice = round($firstPrice);


          return view('front.shop.single.index',compact('product',

              'firstPrice'
          ));

      }


        abort(404,'Product Options Not Found');


    }

    public function comment(Request $request)
    {
        $request->validate([
            'username' =>'string|max:100',
            'review_details' => 'string|max:500',
            'product_id' => 'numeric|exists:products,id',


        ]);
        if (auth()->check())
        {

            $username = $request->input('username');
            $details = $request->input('review_details');
            $user_id = auth()->user()->id;
            $product_id = $request->input('product_id');
            $product_id_hash = $request->input('product_id_hash');

            if (!hash_equals(hash('sha256', $product_id), $product_id_hash))
            {
                return response()->json(['error' => 'Invalid product_id'], 422);

            }

            $comment = new Comment();
            $comment->commentable_type = 'product';
            $comment->commentable_id = $product_id;
            $comment->username = $username;
            $comment->text = $details;
            $comment->user_id = $user_id;
            $comment->save();
            Alert::success('','دیدگاه شما ثبت و پس از بررسی نمایش داده خواهد شد');
            return redirect()->back();
        }
        else
        {
            Alert::warning('ابتدا وارد حساب کاربری خود شوید');
            return redirect()->back();
        }
    }


    private function nextProduct($product)
    {

        return $product->whereHas('categories', function ($query) use ($product) {
            $query->whereIn('category_id', $product->categories->pluck('id')->toArray());
        })
            ->where('id', '>', $product->id)
            ->orderBy('id')
            ->first() ?? $product->whereNotNull('name')->first();

    }


    private function prevProduct($product)
    {

        return $product->whereHas('categories', function ($query) use ($product) {
            $query->whereIn('category_id', $product->categories->pluck('id')->toArray());
        })
            ->where('id', '<', $product->id)
            ->orderBy('id','desc')
            ->first() ?? $product->whereNotNull('name')->first();

    }

    private function increaseView($product)
    {
        $productKey = 'product_' . $product->id;

        if (!session($productKey))
        {
            $product->views++; // افزایش تعداد بازدیدها
            $product->save();

            session([$productKey => true]);

        }
    }






}
