<?php

namespace App\Livewire\Front\Panel\Components;

use App\Models\Message;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Messages extends Component
{
    use LivewireAlert,WithPagination,WithoutUrlPagination;


    #[Locked]
    public $messageId = '';

    public function removeMessage($id): void
    {
        $this->messageId = $id;
        $this->validate([
            'messageId' => 'required|exists:messages,id'
        ]);
        $message = Message::find($this->messageId);
        $message->delete();
        $this->alert('success', 'پیام با موفقیت حذف شد');
    }
    public function markAsRead($id): void
    {
        $this->messageId = $id;
        $this->validate([
            'messageId' => 'required|exists:messages,id'
        ]);
        $message = Message::find($this->messageId);
        $message->is_read = 1;
        $message->save();
        $this->alert('success', 'پیام با موفقیت حذف شد');
    }



    public function mount()
    {

    }
    public function render()
    {
        $message_list = auth()->user()->messages()->latest()->paginate(10);
        return view('livewire.front.panel.components.messages', compact('message_list'));
    }

}
