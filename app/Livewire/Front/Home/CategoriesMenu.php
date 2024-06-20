<?php

namespace App\Livewire\Front\Home;

use App\Models\Category;
use Livewire\Component;

class CategoriesMenu extends Component
{
    public $categories = [];
    public function mount()
    {
       $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.front.home.categories-menu');
    }
}
