<div>
    @if($products->isNotEmpty())
        <div class="d-flex align-items-center justify-content-between mb-4 pb-2">
            <h1 class="h2 mb-0"></h1><a wire:click.debounce.1000ms="confirmDelete" class=" mt-3 fw-bold text-decoration-none" href="#"><i class="fi-x fs-xs mt-n1 me-2"></i>
               موارد حذف همه</a>
        </div>

        @foreach($products as $index=> $product)
            <div wire:key="{{ $product->id }}" class="card card-hover card-horizontal border-0 shadow-sm mb-4">
                <div class="card-img-top position-relative" style="background-image: url({{ asset($product->images()->first()->file_path) }});"><a wire:navigate
                                                                                                                                                   class="stretched-link"
                                                                                                                                                   href="{{ route('singleProduct',['id'=>$product->id,'slug'=>slugMaker($product->name)]) }}"></a>
                    <div class="position-absolute start-0 top-0 pt-3 ps-3"><span class="d-table badge bg-success mb-1">فعال</span><span
                            class="d-table badge bg-info">جدید</span>
                    </div>
                    <div class="position-absolute end-0 top-0 pt-3 pe-3 zindex-5">
                        <button class="btn btn-icon btn-light btn-xs text-primary rounded-circle shadow-sm" type="button" data-bs-toggle="tooltip" data-bs-placement="right"
                                aria-label="حذف از مورد علاقه" data-bs-original-title="حذف از مورد علاقه"><i class="fi-heart-filled"></i></button>
                    </div>
                </div>
                <div class="card-body position-relative pb-3">

                    <h3 class="h6 mb-2 fs-base"><a wire:navigate class="nav-link stretched-link" href="{{ route('singleProduct',['id'=>$product->id,'slug'=>slugMaker
                ($product->name)]) }}">{{ $product->name }}</a></h3>
                    <p class="mb-2 fs-sm text-muted">{{ $product->categories()->first()->name }}</p>
                    <div><i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>شروع قیمت از 1260000 ت</div>
                    <div class="d-flex align-items-center justify-content-center justify-content-sm-start border-top pt-3 pb-2 mt-3 text-nowrap"><span
                            class="d-inline-block me-4 fs-sm">3<i class="fi-bed ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block me-4 fs-sm">2<i
                                class="fi-bath ms-1 mt-n1 fs-lg text-muted"></i></span><span class="d-inline-block fs-sm">2<i
                                class="fi-car ms-1 mt-n1 fs-lg text-muted"></i></span></div>
                </div>
            </div>
        @endforeach
    @else
        <div class="d-flex text-center">
            <h4 class="mx-auto text-primary fw-normal fs-sm mt-5"> محصول مورد علاقه ای اضافه نشده است </h4>
        </div>
    @endif


</div>
