<?php

namespace App\Http\Controllers\Front\Store\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryIndexController extends Controller
{
    public function index(Request $request, $category_id)
    {
        $category = Category::find($category_id);
         $categoryName = $category->name;

        if (!$category)
        {
            // دسته مورد نظر یافت نشد
            abort(404);
        }

        
        $products = $category->products()->paginate(request()->query('items') ?? 20)->appends(request()->query());

        return view('front.shop.products.index', compact(['products','categoryName']));
    }
}
