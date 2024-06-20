<?php

namespace App\Http\Controllers\Front\Store\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandIndexController extends Controller
{
    public function index(Request $request,$brand_id)
    {
        $brandName  = Brand::findorfail($brand_id)->name;

        $query = Product::query();

        $query->where('brand_id',$brand_id)
            ->where('is_active','=',1)
            ->when($request->has('max_price'), function ($q) use ($request) {
            $q->whereHas('types', function ($subQ) use ($request) {
                $subQ->where('price', '<=', $request->max_price);
            });
        });


        $products = $query->paginate(request()->query('items') ?? 20)->appends( request()->query() );

        return view('front.shop.products.index',compact('products','brandName'));
    }


    public function brandList()
    {
        $brands = Brand::paginate(30);
        return view('front.shop.brand.index',compact('brands'));

    }


}
