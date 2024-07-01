<?php

namespace App\Livewire\Front\Blog;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class IndexBlog extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $categories = '';
    public $selectedFilter = null;
    public $selectedCategoryId = null;
    public $selectedCategory= null;
    public $search = '';
    protected $posts;
    public $tid = null;
    public $cid = null;


    public function mount()
    {
        $this->categories = Category::whereType('post')->get();
        $this->posts = Post::cursorPaginate(2);
        $this->tid = request()->query('tid');
        $this->cid = request()->query('cid');
        if ($this->cid)
        {
            $this->selectedCategory = $this->cid;
        }

    }
    public function updatedSelectedFilter()
    {
        $this->reset('search');
    }
    public function updatedSelectedCategory($categoryId = null)
    {
        $this->reset('search');
        $this->reset('selectedFilter');
    }

    public function getCategory($value)
    {
        $this->selectedCategoryId = $value;

    }

    public function render()
    {
        $posts = Post::query();

        if ($this->selectedCategoryId)
        {
            $category = Category::findOrFail($this->selectedCategoryId);
            $posts = $category->posts();
        }


        if ($this->search != '' && Str::length($this->search) > 2) {
            $posts->where('title', 'like', "%$this->search%");
        } elseif ($this->selectedFilter == 'new') {

            $posts->orderBy('created_at', 'desc');
        } elseif ($this->selectedFilter == 'view') {
            $posts->orderBy('views', 'desc');
        } elseif ($this->selectedFilter == 'old') {
            $posts->orderBy('created_at', 'asc');
        } elseif ($this->selectedCategory)
        {
            $category = Category::findOrFail($this->selectedCategory);
            $posts = $category->posts();
            $this->reset(['search', 'selectedFilter']);
        }
        elseif (isset($this->tid) && is_numeric($this->tid))
        {
            $tag = Tag::findOrFail($this->tid);
            $posts = $tag->posts();
        }
        elseif (isset($this->cid) && is_numeric($this->cid))
        {
            $category = Category::findOrFail($this->cid);
            $posts = $category->posts();
        }
        else {
            $posts->latest();
        }

        $posts = $posts->paginate(20);
        $title = 'Blog | ' . getSetting('website_title');


        return view('livewire.front.blog.index-blog', ['posts' => $posts])->title($title);
    }
}
