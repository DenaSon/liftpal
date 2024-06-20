@foreach ($innerSubCategories as $subcategory)
    @if($subcategory->products->count() )
    <a href="#item-{{ $subcategory->id }}" class="list-group-item d-flex align-items-center" data-bs-toggle="collapse">
        <div class="category-wrapper d-flex align-items-center">
            @if (count($subcategory->subcategories))
                <i class="fas fa-angle-right ms-2 font-13"></i>
            @endif

                <a title="{{ $subcategory->name }}" href="{{ route('indexByCategory',['category'=>$subcategory,'slug'=>slugMaker($subcategory->name)])}}" class="category-name">{{ $subcategory->name }}</a>

        </div>
    </a>
    <div class="list-group collapse" id="item-{{ $subcategory->id }}">

    </div>
    @endif
@endforeach
