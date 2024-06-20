<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function getSubcategories(Request $request)
    {

        $request->validate(['category_id'=> 'min:0|max:1000000|exists:categories,id']);

        $category_ids = $request->input('category_id');

        if (empty($category_ids)) {
            $subcategoriesWithParentId = [];
        }

        else
        {
            $subcategories = Category::whereIn('parent_id', $category_ids)->get();

            // افزودن شماره دسته والد به زیردسته‌ها
            $subcategoriesWithParentId = [];
            foreach ($subcategories as $subcategory) {
                $subcategoryWithParentId = $subcategory->toArray();
                $subcategoriesWithParentId[] = $subcategoryWithParentId;
            }

            return response()->json($subcategoriesWithParentId);
        }
        }







}
