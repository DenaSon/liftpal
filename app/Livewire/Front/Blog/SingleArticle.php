<?php

namespace App\Livewire\Front\Blog;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Phpml\Classification\KNearestNeighbors;

use Livewire\Component;

class SingleArticle extends Component
{
    use LivewireAlert;


    public $article;
    public $categories = '';
    public $post=[];


    #[Locked]
    public $postId;
    public $comment_name ='';
    public $email = null;


    public $comment_text ='';

    public function mount($id)
    {


        $this->post = Post::findorfail($id);
        $this->postId = $id;
        $this->categories = Category::whereType('post')->get();

    }

    public function saveCommentLimit()
    {
        $this->validate([
            'comment_name'=>'required',
            'comment_text' =>'required|string|max:1000',

        ]);

        if ( $this->email !== null )
        {
            abort(403);

        }

        $comment =  new Comment([
            'user_id'=> auth()->id() ?? null,
            'commentable_type' => 'post',
            'commentable_id' => $this->postId,
            'username' => $this->comment_name,
            'text' => $this->comment_text,

    ]);

        $comment->save();
        $this->reset(['comment_name','comment_text']);
        $this->alert('success','دیدگاه شما ثبت شد و پس از تایید نمایش داده خواهد شد.',['position'=>'center']);

    }

    public function saveComment()
    {
        $executed = RateLimiter::attempt(
            'save-comment'.session()->getId(),
            2,
            function()
            {
                $this->saveCommentLimit();
            }
        );

        if (! $executed) {
            $this->alert('warning','لطفا چند لحظه دیگر مجددا سعی کنید.',['position'=>'center']);
        }
    }



    public function render()
    {
        return view('livewire.front.blog.single-article')->title($this->post->title ?? '');
    }
}
