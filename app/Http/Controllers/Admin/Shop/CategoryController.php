<?php

namespace App\Http\Controllers\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $categories = Category::orderbyDesc('created_at')->whereType('product')->paginate(60);

        $categoriesList = Category::OrderBydesc('created_at')->whereType('product') ->get();

        return view( 'admin.store.categories.index', compact( [ 'categories' ,'categoriesList'] ) );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



            $request->validate([
                'name' => 'string|required|max:40|min:1',
                'parent_id' => 'nullable|min:0|max:10000000'
            ]);

            try {
                Cache::forget('product_categories');
            $categoryName = $request->post('name');
            $parentId = $request->post('parent_id');

            if ($parentId == 'null') {
                $exists = Category::whereName($categoryName)->whereType('product')->first();
                if(!$exists)
                {
                    $category = new Category();
                    $category->name = $categoryName;
                    $category->type = 'product';
                    $category->save();

                }
                else
                {
                    Alert::warning('نام دسته تکراری است.');
                    return redirect()->back();
                }



                Alert::success('دسته والد ثبت شد.');
                return redirect()->back();

            }
            else {

                $category = new Category();
                $category->name = $categoryName;
                $category->type = 'product';
                $category->parent_id = $parentId;
                $category->save();

                $message = 'زیر دسته ثبت شد';
                Alert::success($message);
                return redirect()->back();

            }

        }
        catch( Throwable $e)
        {
            setLog('Create-shopCategory',$e->getMessage(). $e->getFile() . ' line : ' . $e->getLine(),'danger');
            Alert::error($e->getMessage());

        }
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $categoriesWithSubcategories = Category::orderbyDesc('created_at')->paginate(10);
        $categoriesList = Category::OrderBydesc('created_at')->orderByDesc('created_at') ->get();


            $catName = Category::where('id',$id)->value('name');





        return view( 'admin.store.categories.edit', compact( [ 'categoriesWithSubcategories', 'categoriesList','id','catName'] ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try {
            Cache::forget('product_categories');
            $category = Category::findorfail($id);
            $category->name = $request->post('name');
            $category->save();
            Alert::success('نام دسته ویرایش شد');
            return redirect()->route('categories.index');
        }
        catch (Throwable $e)
        {
            setLog('Update-shopCategory',$e->getMessage(). $e->getFile() . ' line : ' . $e->getLine(),'danger');
            Alert::error($e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try
        {
            Cache::forget('product_categories');
            $category = Category::find($id);
            $this->deleteSubcategories($category);
            // حذف دسته فعلی
            $category->delete();

        }
        catch (Throwable $e)
        {
            setLog('Delete-shopCategory',$e->getMessage(). ' '. $e->getFile() . ' line : ' . $e->getLine(),'danger');
            Alert::error($e->getMessage());
        }

        return redirect()->route('categories.index');
    }



    protected function deleteSubcategories($category)
    {
        foreach ($category->subcategories as $subCategory) {
            $this->deleteSubcategories($subCategory); // حذف زیردسته‌ها بازگشتی
            $subCategory->delete(); // حذف زیردسته فعلی
        }


    }
}
