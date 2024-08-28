<?php

namespace App\Livewire\Front\User;

use App\Models\Comment;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;


class Expert extends Component
{
    use LivewireAlert,WithPagination;

    public $username = '';
    public $fullName;
    public $comment_text = '';
    public $user = null;
    public $passedDays;
    public $comments_list;
    #[Locked]
    public $comment_id = 0;
    public $title;
    public $messageText;

    public function sendMessage()
    {
        if (!auth()->check())
        {
            $this->alert('info','لطفا ابتدا وارد حساب کاربری خود شوید.');
            return false;
        }

        try
        {
            $this->validate(
                [
                    'fullName' => 'required|string|min:3',
                    'title' => 'required|string|min:3|max:60',
                    'messageText' => 'required|string|min:10|max:255',

                ],
            );
           $execute =  RateLimiter::attempt(
                'send-message',
                1,function ()
            {
                $technician_id = $this->user->id;
                $sender_id = auth()->user()->id;
                $title = $this->title;
                $fullName = $this->fullName;
                $message = $this->messageText;

                $messageModel = new Message();
                $messageModel->sender_id = $sender_id;
                $messageModel->receiver_id = $technician_id;
                $messageModel->title = $title;
                $messageModel->content = $fullName . ' : ' . $message;
                $messageModel->save();
                $this->alert('success','پیام شما با موفقیت ارسال شد');
            }
            ,300
            );
           if (!$execute)
           {
               $this->alert('warning','در هر 1 ساعت تنها یک پیام میتوانید ارسال کنید');
           }
        }
        catch (Throwable $e)
        {
            $this->alert('warning',$e->getMessage());
        }

    }

    public function like($comment_id)
    {
        $executed = RateLimiter::attempt(
            'like-' . session()->getId() . '-' . $comment_id, // Unique key for each comment per session

            1,
            function () use ($comment_id)
            {

                $this->comment_id = $comment_id;
                try
                {
                    $this->validate(['comment_id'=> 'numeric|exists:comments,id']);
                    $comment = Comment::find($this->comment_id);
                    $comment->likes += 1;
                    $comment->save();
                }
                catch (Throwable $e)
                {
                    $this->alert('warning',$e->getMessage());
                }
            }
            ,500
        );

    }

    public function dislike($comment_id)
    {
        $executed = RateLimiter::attempt(
            'like-' . session()->getId() . '-' . $comment_id, // Unique key for each comment per session

            1,
            function () use ($comment_id)
            {

                $this->comment_id = $comment_id;
                try
                {
                    $this->validate(['comment_id'=> 'numeric|exists:comments,id']);
                    $comment = Comment::find($this->comment_id);
                   if ($comment->likes > 0)
                   {

                       $comment->likes -= 1;
                       $comment->save();
                   }
                }
                catch (Throwable $e)
                {
                    $this->alert('warning',$e->getMessage());
                }
            }
            ,600
        );
    }

    public function saveComment()
    {
        $executed = RateLimiter::attempt(
            'expert-comment-' . session()->getId(),
            2,
            function ()
            {
                try {
                    $this->validate([
                        'comment_text' => 'required|string|max:255',
                        'username' => 'required|string|max:100',
                    ]);
                    $this->technician_id = $this->user->id;
                    $comment = new Comment();
                    $comment->user_id = null;
                    $comment->username = $this->username;
                    $comment->text = $this->comment_text;
                    $comment->commentable_type = User::class;
                    $comment->commentable_id = $this->technician_id;
                    $comment->parent_id = null;
                    $comment->rating = $this->rating ?? null;
                    $comment->likes = 0;
                    $comment->status = 'hidden';

                    // Save the comment
                    $comment->save();
                    $this->alert('success', 'دیدگاه شما ثبت و پس از تایید نمایش داده خواهد شد');
                    $this->reset(['comment_text', 'username']);
                }
                catch (Throwable $e)
                {
                    $this->alert('warning', $e->getMessage());
                }
            },
            300,
        );

        if (!$executed) {
            $this->alert('warning', 'تعداد درخواست های مجاز شما به اتمام رسیده است');
        }
    }

    public function mount($id, $name='')
    {
        $this->user = User::with('profile', 'comments','skills','addresses','images')
            ->whereRole('technician')
            ->findOrFail($id);

        $createdAt = new Carbon($this->user->created_at);
        $currentDate = Carbon::now();
        $this->passedDays = $currentDate->diffInDays($createdAt);
        $this->comments_list = Comment::where('commentable_type', User::class)->whereStatus('published')->latest()->take(20)->get();
        $this->username = auth()->user()?->profile?->name . ' ' . auth()->user()?->profile?->last_name ;
        $this->fullName = $this->username;

    }

    public function render()
    {
        $username = $this->user->profile->name . ' ' . $this->user->profile->last_name;
        $address = $this->user?->addresses->first()?->province ;
        if($address)
        {
            $addressStr = ' در ' . $address;
        }
        else
        {
            $addressStr = '';
        }


        $text = 'کارشناس فنی';



        return view('livewire.front.user.expert')->title($username . ' ' . $text .' '.$addressStr );
    }
}
