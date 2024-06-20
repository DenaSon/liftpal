<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderbyDesc('created_at')->whereType('post')->paginate(getSetting('default_pagination_number') ?? 10);
        $categoriesList = Category::OrderBydesc('created_at')->whereType('post')->orderByDesc('created_at') ->get();
        return view( 'admin.blog.categories.index', compact( [ 'categories' ,'categoriesList'] ) );

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

        ]);
        try {
            $categoryName = $request->input('name');

                $exists = Category::whereName($categoryName)->whereType('post')->first();
                if(!$exists)
                {
                    $category = new Category();
                    $category->name = $categoryName;
                    $category->type = 'post';
                    $category->save();

                }
                else
                {
                    Alert::warning('نام دسته تکراری است.');
                    return redirect()->back();
                }

        }
        catch( Throwable $e)
        {
            setLog('Create-blogCategory',$e->getMessage(). $e->getFile() . ' line : ' . $e->getLine(),'danger');
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
    public function edit(string $id)
    {
        $categories = Category::orderbyDesc('created_at')->whereType('post')->paginate( getSetting('default_pagination_number') );
        $categoriesList = Category::OrderBydesc('created_at')->whereType('post')->orderByDesc('created_at') ->get();
        $catName = Category::where('id',$id)->value('name');

        return view( 'admin.blog.categories.edit', compact( [ 'categories', 'categoriesList','id','catName'] ) );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {

            $category = Category::findorfail($id);
            $category->name = $request->post('name');
            $category->save();

        }
        catch (Throwable $e)
        {
            setLog('Update-blogCategory',$e->getMessage(). $e->getFile() . ' line : ' . $e->getLine(),'danger');
            Alert::error($e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {

            $type = $request->post('type');

            if ($type == 'category') {
                $category = Category::findOrFail($id);
                $category->products()->detach();
                $category->subcategories()->each(function ($subcategory) {
                    $subcategory->products()->detach();
                });

                Category::where('id', $id)->delete();
            }

        } catch (Throwable $e)
        {
            setLog('Delete-blogCategory',$e->getMessage(). ' '. $e->getFile() . ' line : ' . $e->getLine(),'danger');
            Alert::error($e->getMessage());
        }

        return redirect()->route('blogCategories.index');
    }
}
