<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate(['views' =>  'nullable|string']);

        $views = $request->input('views') ?? null;

        $tags = Tag::whereType('post')
        ->when($views,function($query) use ($views) {
                $query->orderByDesc('views');
            })
            ->     when(!$views,function($query) use ($views) {
                $query->orderByDesc('created_at');
            })
            -> paginate( getSetting('default_pagination_number'));

        $avg = Tag::averageViews() / 2;

        $mostViewedTags = Tag::where('views','>',$avg)->whereType('post')->inRandomOrder()->take(17)->get();



        return view('admin.blog.tags.index',compact('tags','mostViewedTags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {


            $request->validate(['name' => 'required|string|max:50']);

            $name = $request->input('name');

            $exists = Tag::whereName($name)->whereType('post')->first();

            if ($exists) {
                Alert::warning('برچسب تکراری است.');
                return redirect()->back();
            }

            else
            {
                $tag = new Tag();
                $tag->name = $name;
                $tag->type = 'post';
                $tag->save();

                Alert::success('برچسب ثبت شد.');
                return redirect()->back();

            }


        }
        catch (Throwable $e)
        {
            setLog('Store-BlogTag',$e->getMessage(),'danger');
        }
        return true;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name'=>'required|string|max:50']);
        try {


        $name = $request->input('name') ?? null;
        $existingTag = Tag::where('name', $name)->whereType('post')->where('id', '!=', $id)->first();
        if ($existingTag) {
            // The name already exists for another tag, handle the error or provide a message
            Alert::warning('این برچسب تکراری است');
            return redirect()->back();
        }
        $tag = Tag::where('id',$id)->first();
        $tag->name = $name;
        $tag->save();

        Alert::success('ویرایش موفق','برچسب ویرایش شد');
        return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Update-BlogTag',$e->getMessage(),'danger');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
