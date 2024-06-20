<?php

namespace App\Livewire\Front\Shop;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use RakibDevs\Weather\Weather;
use Throwable;

class ProductIndex extends Component
{
    use WithPagination;
    use LivewireAlert;

    #[Url(as: 'q')]
    public  $search;
    public $categories;
    public $subcategories;
    public $tags;
    public $sortby;

    public $selectedCategoryIds = [];
    public $selectedSubcategoryIds = [];

    public $selectedTagIds = [];



    public function mount()
    {
        $this->categories = Category::whereParentId(null)->whereType('product')->get();

        $this->tags = Tag::has('products')->inRandomOrder()->get();

    }

    public function updatedSelectedCategoryIds()
    {
        $categories = Category::has('products')->whereParentId(null)->whereIn('id', $this->selectedCategoryIds)->get();

        $tagNames = $categories->pluck('name')->toArray();

        $this->tags = Tag::has('products')->whereType('product')
        ->where(function ($query) use ($tagNames) {
                foreach ($tagNames as $tagName) {
                    $query->orWhere('name', 'like', '%' . $tagName . '%');
                }
            })
            ->get();

        //
        $this->subcategories = Category::has('products')->whereType('product')
            ->where('parent_id','!=',null)
            ->whereIn('parent_id', $this->selectedCategoryIds)
            ->get();

        $this->reset('selectedTagIds', 'selectedSubcategoryIds');

        }



    public function deleteFilters()
    {
        $this->reset('selectedTagIds', 'selectedCategoryIds','selectedSubcategoryIds');
        $this->tags = Tag::has('products')->inRandomOrder()->get();
    }




    public function render()
    {
        try {
            $this->validate([
                'selectedCategoryIds' => 'exists:categories,id',
                'selectedSubcategoryIds' => 'exists:categories,id',
                'selectedTagIds' => 'exists:tags,id',
                'search' => 'nullable|string|max:30|min:2',
                'sortby' => ['nullable', 'in:new,view,inprice,deprice']

            ]);

        }
        catch (Throwable $e)
        {
            $this->alert('info', $e->getMessage());
        }

        $products = Product::when($this->selectedCategoryIds, function ($query)
        {
            $query->whereHas('categories', function ($query) {
                $query->whereIn('id', $this->selectedCategoryIds);

            });
        })
            ->when($this->selectedTagIds, function ($query)
            {
                $query->whereHas('tags', function ($query) {
                    $query->whereIn('id', $this->selectedTagIds);
                });
            })
            ->when($this->selectedSubcategoryIds, function ($query)
            {
                $query->whereHas('categories', function ($query) {
                    $query->whereIn('id', $this->selectedSubcategoryIds);
                });
            })
            ->when($this->sortby == 'inprice', function ($query)
            {
                $query->whereHas('types')
                    ->orderBy(function($subquery) {
                        $subquery->select('price')
                            ->from('types')
                            ->whereColumn('products.id', 'types.product_id')
                            ->orderBy('price', 'ASC')
                            ->limit(1);
                    }, 'DESC');
            })
            ->when($this->sortby == 'deprice', function ($query)
            {
                $query->whereHas('types')
                    ->orderBy(function($subquery) {
                        $subquery->select('price')
                            ->from('types')
                            ->whereColumn('products.id', 'types.product_id')
                            ->orderBy('price', 'DESC')
                            ->limit(1);
                    }, 'ASC');
            })
            ->when($this->sortby =='view', function ($query)
            {
                $query->orderBy('views','desc');
            })
            ->when($this->sortby =='new', function ($query)
            {
                $query->orderBy('created_at','desc');
            })
            ->when($this->search, function ($query)
            {
                $query->where('name','like','%'.$this->search.'%');
            })
            ->paginate(20) ?? [];


        return view('livewire.front.shop.product-index', compact('products'))
            ->title('محصولات');
    }
}
