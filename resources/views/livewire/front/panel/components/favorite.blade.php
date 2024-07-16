<div>

    @if($products->isNotEmpty())

        <div class="d-flex align-items-center justify-content-end mb-4 pb-2">


            <button  wire:click.debounce="confirmDelete" type="button" class="btn btn-outline-primary  mt-3">

                <i class="fi-trash me-2 "></i>حذف همه
            </button>
        </div>
    @else

        <div class="text-center mt-3">
            <span class="fw-bold fs-sm mb-5 ">محصولی در مورد علاقه‌ها وجود ندارد</span>
            <div class="clearfix"></div>
            <a wire:navigate class="btn btn-outline-primary btn-lg w-50 mt-5" href="{{ route('shop') }}"><i class="fi-cart me-2"></i> خرید </a>
        </div>

    @endif

    @foreach($products as $index => $product)
        <div class="card card-hover card-horizontal border-0 shadow-sm mb-4 mt-3">
            <div class="card-img-top  d-flex justify-content-center ">
                <img src="{{ asset($product->images()?->first()?->file_path) }}" style="max-height: 200px;">

            </div>
            <div class="card-body  pb-3">
                <div class="text-center">
                    <h3 class="h6 mb-2mt-2 fs-base "><a wire:wire:navigate class="nav-link " href="{{ route('singleProduct',['id'=>$product->id,'slug'=>slugMaker($product->name)])
                    }}">{{ $product->name }}</a></h3>
                    <p class="mb-2mt-2 fs-sm ">{{ $product->categories->first()->name }}</p>
                    <div class="mb-3">
                        @foreach($product->types as $type)

                            <span class="ms-1">{{ number_format($type->price) }}</span> <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>

                        @endforeach
                    </div>
                </div>
                <div class="d-grid gap-2 border-top d-md-block">
                    <div class="container mb-0 mt-3">
                        <div class="row justify-content-between">
                            <button wire:navigate wire:click="deleteItem({{$product->id}})" class="col-3 btn btn-outline-primary">
                                <i class="fi-trash"></i>
                            </button>
                            <a wire:navigate class="col-8 btn btn-outline-primary" href="{{ route('singleProduct',['id'=>$product->id,'slug'=>slugMaker($product->name)]) }}">
                                خرید
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


</div>
