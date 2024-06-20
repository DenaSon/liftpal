<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tid' => 'numeric|exists:tags,id',
            'cid' => 'numeric|exists:categories,id',
            'search' => 'string|max:20|min:2',
        ]);

        $query = Post::query();

        $query->when($request->has('cid'), function ($query) use ($request) {
            $categoryId = $request->input('cid');

            return $query->whereHas('categories', function ($categoryQuery) use ($categoryId) {
                $categoryQuery->where('category_id', $categoryId);
            });
        });

        $query->when($request->has('tid'), function ($query) use ($request) {
            $tagId = $request->input('tid');

            Post::whereHas('tags', function ($tagQuery) use ($tagId) {
                $tagQuery->where('tag_id', $tagId);
            })->increment('views');

            return $query->whereHas('tags', function ($tagQuery) use ($tagId) {
                $tagQuery->where('tag_id', $tagId);
            });
        });

        $query->when($request->has('search'), function ($query) use ($request) {
            $search = $request->input('search');
            return $query->where('title', 'like', "%$search%")->get();
        });

        $posts = $query->paginate(15)->appends(request()->query());
        $best_posts = Post::orderBy('views', 'desc')->get();
        $categories = Category::where('type', 'post')->get();

        return view('front.blog.index', compact('posts', 'categories', 'best_posts'));

    }


    public function single(Post $post,$slug)
    {
        $this->increaseView($post);
        //$posts = Post::with('images')->get();
        $categories = Category::where('type','post')->get();
        $best_posts = Post::orderBy('views', 'desc')->get();
        return view('front.blog.single',compact('post','best_posts','categories'));

    }

    public function storeComment(Request $request)
    {
        return $request->all();
    }


    private function increaseView($post)
    {
        $postKey = 'post_' . $post->id;

        if (!session($postKey))
        {
            $post->views++; // افزایش تعداد بازدیدها
            $post->save();

            session([$postKey => true]);

        }
    }


}
