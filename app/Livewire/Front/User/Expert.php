<?php

namespace App\Livewire\Front\User;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\RateLimiter;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Throwable;


class Expert extends Component
{

    public $username = '';
    public $comment_text = '';
    public $user = null;
    public $passedDays;
    use LivewireAlert;


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
                    $this->alert('error', $e->getMessage());
                }
            }
        );

        if (!$executed) {
            $this->alert('error', 'تعداد درخواست های مجاز شما به اتمام رسیده است');
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
