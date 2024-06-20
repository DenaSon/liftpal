<aside class="col-lg-2 col-xl-2 border-top-lg border-end-lg shadow-sm px-3 px-xl-4 px-xxl-5 pt-lg-2">
    <div class="offcanvas-lg offcanvas-end" id="filters-sidebar">


        <div class="offcanvas-body py-lg-4">

            <div class="pb-4 mb-2">
                <h3 class="h6">دسته بندی</h3>

                <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false" data-simplebar-direction="rtl" style="height: 11rem;">

                    @foreach($categories as $category)

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="category-{{$category->id}}" wire:model.live.debounce.250ms="selectedCategoryIds" value="{{ $category->id }}">
                        <label class="form-check-label fs-sm" for="category-{{$category->id}}">{{ $category->name }}</label>
                    </div>

                    @endforeach

                </div>

            </div>
            @if($subcategories && $subcategories->count() > 0)
            <div class="pb-4 mb-2">
                <h3 class="h6">زیر‌دسته</h3>

                <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false" data-simplebar-direction="rtl" style="height: 11rem;">

                    @foreach($subcategories as $subcategory)

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="subcategory-{{$subcategory->id}}" wire:model.live.debounce.250ms="selectedSubcategoryIds" value="{{ $subcategory->id }}">
                            <label class="form-check-label fs-sm" for="subcategory-{{$subcategory->id}}">{{ $subcategory->name }}</label>
                        </div>

                    @endforeach

                </div>

            </div>
            @endif






            <div class="pb-4 mb-2">
                <h3 class="h6">کلمات کلیدی </h3>
                <div class="overflow-auto" data-simplebar data-simplebar-auto-hide="false" data-simplebar-direction="rtl" style="height: 11rem;">

                    @foreach($tags->take(15) as $tag)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="tag-{{ $tag->id }}" wire:model.live.debounce.250ms="selectedTagIds" value="{{ $tag->id }}">
                        <label class="form-check-label fs-sm" for="tag-{{ $tag->id }}"> {{ $tag->name }}</label>
                    </div>
                    @endforeach

                </div>
            </div>






            <div class="border-top py-4">
                <div class="d-flex justify-content-center">
                    <button wire:click="deleteFilters" class="btn btn-outline-primary" type="button">
                        <i class="fi-rotate-right me-2"></i>حذف فیلتر
                    </button>
                </div>
            </div>
            <div class="form-check form-switch form-switch-light">
                <input class="form-check-input" type="checkbox" id="negotiated-price">
                <label class="form-check-label fs-sm" for="negotiated-price">قیمت توافقی</label>
            </div>

        </div>
    </div>
</aside>
