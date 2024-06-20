<li>
<a  href="#">دسته بندی<span class="submenu-indicator"></span></a>
<ul  class="nav-dropdown nav-submenu">
@foreach($categories->where('parent_id',null) as $category)
<li>
    <a wire:navigate href="#">{{ $category->name }}<span class="submenu-indicator"></span></a>
    @if($category->subcategories)
        @if (count($category->subcategories) )
        <ul class="nav-dropdown nav-submenu">
            @foreach($category->subcategories as $subcategory)
                <li><a wire:navigate href="#">{{ $subcategory->name }}</a></li>
            @endforeach
        </ul>
    @endif
    @endif
</li>
@endforeach
</ul>
</li>
