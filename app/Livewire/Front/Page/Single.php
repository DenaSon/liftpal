<?php

namespace App\Livewire\Front\Page;

use App\Models\Page;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Single extends Component
{
    use LivewireAlert;
    #[Locked]
    public $pageId = null;
    public $slug = null;
    public $page = null;

    public function mount($id)
    {
        $this->pageId = $id;

        $this->page = Page::whereIsActive(1)->findOrFail($this->pageId);
    }


    public function render()
    {

        return view('livewire.front.page.single');
    }
}
