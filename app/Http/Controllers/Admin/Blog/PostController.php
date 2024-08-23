<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\CreateRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Order;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Imagick\Driver;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;
use Intervention\Image\ImageManager;
//use  Intervention\Image\Drivers\Imagick\Driver;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {



        $request->validate(['search' => 'nullable|string|max:255','filter']);

        $search = $request->input('search') ?? null;
        $posts = Post::orderByDesc('created_at') ->when($request->has('search'), function ($query) use ($search) {
            $query->where('title','like', "%$search%");

        })
            ->paginate( getSetting('default_pagination_number') ) ->appends( $request ->query() );

        return view('admin.blog.posts.index',compact('posts') );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::whereType('post')->orderByDesc('created_at')->limit(200)->get(['id', 'name']);
        $tags = Tag::whereType('post')->orderByDesc('created_at')->limit(150)->get(['id','name']);

        return view('admin.blog.posts.create',compact(['categories','tags']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        try {
            Cache::forget('new_posts');
            $title = $request->input('title');
            $details = $request->input('details', 'متن مقاله');
            $description = $request->input('description');
            $categoryIds = $request->input('categories', []);
            $tags = $request->input('tags', []);
            $is_active = $request->input('status') == 'published' ? 1 : 0;
            $is_featured = $request->input('featured') ? 1 : 0;
            $additional_info = $request->input('note', '');

            $post = Post::create([
                'user_id' => auth()->id() ?? 0,
                'title' => $title,
                'description' => $description,
                'content' => $details,
                'additional_info' => $additional_info,
                'is_active' => $is_active,
                'is_featured' => $is_featured

            ]);

            // Insert Tags
            $type = 'post';
            foreach ($tags as $tagName) {

                $tag = Tag::firstOrCreate(
                    ['name' => $tagName, 'type' => $type],
                    ['name' => $tagName, 'type' => $type]
                );

                $post->tags()->attach($tag->id);
            }

            //Start Save Categories
            $post->categories()->attach($categoryIds);

            //Start Save Images
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $albumId = 'blog_'. $post->id;

                if (app()->isLocal())
                {
                    $directory = public_path('/media/');
                }
                else
                {
                    $directory = ('media');
                }



                $imageName = Str::random(10) . $image->getClientOriginalName();
                $fileSize = $image->getSize() / 1000;
                $fileSize = $image->getSize() / 1000;
                //Check Max File Size
                if ($fileSize > getSetting('max_image_size')) {
                    Alert::warning('تصویر شاخص بارگزاری نشد', 'حجم تصویر انتخاب شده بیش از حد مجاز است');
                    return redirect()->back();
                }
                $image->move($directory, $imageName);

                $this->optimizeImage($directory,$imageName);

                $uploadedImageNames[] = $imageName;
                $fileName = Str::limit($post->title, 18, '');
                $imageData = [
                    'album_id' => $albumId,
                    'file_name' => Str::replace(' ', '_', $fileName),
                    'file_path' => 'media/' . $imageName,
                    'is_index' => 1,
                ];
                $image = Image::create($imageData);
                $uploadedImageId[] = $image->id;
                $post->images()->attach($uploadedImageId);

            }
            //End Image Upload

            Alert::success('مقاله ایجاد شد');
            return redirect()->route('posts.index');
        }
        catch (Throwable $e)
        {
            setLog('Store-Post',$e->getMessage(),'danger');
            return redirect()->route('log-system');
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
        $post = Post::findOrfail($id);
        $categories = Category::orderByDesc('created_at')->whereType('post')->limit(150)->get(['id', 'name']);
        $tags = Tag::orderByDesc('created_at')->whereType('post')->limit(150)->get(['id','name']);

        return view('admin.blog.posts.edit',compact(['post','categories','tags']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateRequest $request, string $id)
    {
        try {

            Cache::forget('new_posts');
            $post = Post::findOrfail($id);
            $title = $request->input('title');
            $details = $request->input('details', 'متن مقاله');
            $description = $request->input('description');
            $categoryIds = $request->input('categories', []);
            $tags = $request->input('tags', []);
            $is_active = $request->input('status') == 'published' ? 1 : 0;
            $is_featured = $request->input('featured') ? 1 : 0;
            $additional_info = $request->input('note', '');
            $post->title = $title;
            $post->content = $details;
            $post->description = $description;
            $post->is_active = $is_active;
            $post->is_featured = $is_featured;
            $post->additional_info = $additional_info;
            $post->save();

            //Update Tags
            $type = 'post';
            foreach ($tags as $tagName) {

                $tag = Tag::updateOrCreate(
                    ['name' => $tagName, 'type' => $type],
                    ['name' => $tagName, 'type' => $type]
                );
                $tagIds[] = $tag->id;

            }
            $post->tags()->sync($tagIds);

            //Update Categories
            $post->categories()->sync($categoryIds);


            //Start Save Images
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $albumId = 'blog_'. $post->id;
                if (app()->isLocal())
                {
                    $directory = public_path('/media/');
                }
                else
                {
                    $directory = ('media');
                }
                $imageName = Str::random(10) . $image->getClientOriginalName();
                $fileSize = $image->getSize() / 1000;
                $fileSize = $image->getSize() / 1000;
                //Check Max File Size
                if ($fileSize > getSetting('max_image_size')) {
                    Alert::warning('تصویر شاخص بارگزاری نشد', 'حجم تصویر انتخاب شده بیش از حد مجاز است');
                    return redirect()->back();
                }
                $image->move($directory, $imageName);
               // $this->optimizeImage($directory,$imageName);




                $uploadedImageNames[] = $imageName;
                $fileName = Str::limit($post->title, 18, '');

                $post->images()->delete();
                $post->images()->detach();

                $imageData = [
                    'album_id' => $albumId,
                    'file_name' => Str::replace(' ', '_', $fileName),
                    'file_path' => 'media/' . $imageName,
                    'is_index' => 1,
                ];
                $image = Image::updateOrCreate($imageData);
                $post->images()->attach($image->id);


            }
            //End Image Upload


            Alert::success('مقاله ویرایش شد', 'تغییرات مقاله با موفقیت اعمال شدند');
            return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Update-Post',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {


            $post = Post::findOrfail($id);
            $post->images()->delete();
            $post->images()->detach();
            $post->categories()->detach();
            $post->tags()->detach();
            $post->delete();
            Alert::success('مقاله حذف شد');
            return redirect()->back();
        }
        catch (Throwable $e)
        {
            setLog('Delete-Post',$e->getMessage(),'danger');
            return redirect()->route('log-system');
        }


    }

    public function liveRemove(Request $request,$id)
    {

        $isConfirmed = $request->post('isConfirmed');

        $isConfirmed = request('isConfirmed');
        $image = Image::findOrFail($id);
        $image_link = ( $image->file_path );

        if ( $isConfirmed == 1 && file_exists($image_link )) {

            unlink($image_link);
        }


        $image->posts()->detach();
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);

    }






    public function live_validator(Request $request): JsonResponse
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [

            'title'      => 'required|min:4|string|max:255' ,
            'description'    => 'string|min:10|max:160' ,
            'categories'     => 'required|exists:categories,id|max:100' ,
            'tags'  => 'required' ,
            'note' => 'nullable|max:240|string',
            'image' => 'image'

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

    /**
     * Optimize and ReScale Image
     */
    private function optimizeImage($directory,$imageName)
    {
        $new_directory = $directory . '/' . $imageName;
        $manager = new ImageManager(new Driver());
        $image = $manager->read($new_directory);
        $image->scale(width: 400, height: 410);
        $image->save(null, 90);
    }

}
