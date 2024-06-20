<?php

namespace App\Http\Controllers\Admin\Global;

use App\Http\Controllers\Controller;


use App\Models\Page;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class PageController extends Controller
{
    use LivewireAlert;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Cache::forget('pages');
        $request->validate(['search' => 'nullable|string|max:255']);

        $search = $request->input('search') ?? null;
        $pages = Page::orderByDesc('created_at') ->when( $request->has('search' ), function ($query) use ($search) {
            $query->where('title','like', "%$search%");

        })
            ->paginate( getSetting('default_pagination_number') ) ->appends( $request ->query() );

        return view('admin.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $request->validate([
            'title'      => 'required|min:3|string|max:255|string' ,
            'details' => 'required|min:10|string',
            'status' => 'required'
        ]);
        try
        {
            Cache::forget('pages');
            $title = $request->input('title');
            if ($request->has('footer_page'))
            {
                $location = 'footer';
            }
            else
            {
                $location = 'header';
            }
            $status = $request->input('status');
            $details = $request->input('details');
            $is_active = $status == 'published' ? 1 : 0;

            $slug = $this->str_slug($title);
            $page = new Page();
            $page->title = $title;
            $page->location = $location;
            $page->content = $details;
            $page->is_active = $is_active;
            $page->slug = $slug;
            $page->save();
            Alert::success('صفحه جدید ساخته شد.');
            return redirect()->back();

        }
        catch (Throwable $e)
        {
            setLog('Create-Page',$e->getMessage(). ' ' . $e->getLine(),'danger');

            return exit('خطایی رخ داده است : '. $e->getMessage());


        }


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
        $page = Page::findOrfail($id);

        return view('admin.page.edit',compact('page'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            Cache::forget('pages');
            $page = Page::findOrfail($id);

            if ($request->has('footer_page'))
            {
                $location = 'footer';
            }
            else
            {
                $location = 'header';
            }

            $title = $request->input('title');
            $details = $request->input('details','متن مقاله');
            $is_active = $request->input( 'status' ) == 'published' ? 1 : 0;
            $page->title = $title;
            $page->content = $details;
            $page->is_active = $is_active;
            $page->location = $location;
            $page->save();
            Alert::success('صفحه ویرایش شد');
            return redirect()->back();

        }
        catch (Throwable $e)
        {
            setLog('Update-Page',$e->getMessage(),'danger');
            return route('log-system');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            Cache::forget('pages');
        $page = Page::findOrfail($id);
        $page->delete();
        Alert::success('صفحه حذف شد');
        return redirect()->back();
        }
        catch(Throwable $e)
    {
        setLog('Delete-Page',$e->getMessage(),'danger');
    }

    }

    public function live_validator(Request $request): JsonResponse
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [

            'title'      => 'required|min:4|string|max:255|string' ,
            'status' => 'required'


            // Add more validation rules as needed
        ]);

        if ($validator->fails()) {
            // Validation failed
            return response()->json(

                ['errors' => $validator->errors()],400);


        }

        // Validation passed
        return response()->json(['errors' => 'No Error'],200);
    }



    private function str_slug(string $value): string
    {

        $text = str_replace(' ','-',$value);
        return $text;
    }


}
