<?php

namespace App\Http\Controllers\Front\Store\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchIndexController extends Controller
{
    public function index(Request $request)
    {

        $request->validate([

            'q' =>'required|string|max:100'
        ]);

        $search = $request->input('q');

        $products =  Product::where('name', 'like', '%' . $search . '%')
            ->where('is_active',1)


            ->paginate(10)->appends(request()->query());

        return view('front.shop.products.index',compact('products'));

    }
}
