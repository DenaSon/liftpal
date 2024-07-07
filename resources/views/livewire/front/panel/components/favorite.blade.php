<div>
    @if($products->isNotEmpty())

        <div class="container row">
            @foreach($products as $index=> $product)
                <div class="col-md-6">

                    {{--                    <div wire:key="{{ $product->id }}" class="card  card-hover  border-0 shadow-sm mb-4">--}}
                    {{--                        <div class=" card-img-top " style="background-image: url({{ asset($product->images()?->first()?->file_path) }}); height:300px; background-size: cover; background-size: cover;--}}
                    {{--        background-position: center;">--}}
                    {{--                            --}}
                    {{--                            <a wire:navigate class="fw-normal fs-sm" href="{{ route('singleProduct',['id'=>$product->id,'slug'=>slugMaker($product->name)]) }}"></a>--}}
                    {{--                        </div>--}}

                    {{--                        <div class=" card-body position-relative pb-3">--}}
                    {{--                            <h6 class="fw-normal fs-sm mb-2 fs-base"><a wire:navigate class="nav-link stretched-link" href="{{ route('singleProduct',['id'=>$product->id,'slug'=>slugMaker--}}
                    {{--        ($product->name)]) }}">{{ $product->name }}</a></h6>--}}
                    {{--                            <p class="mb-2 fs-sm text-muted">{{ $product->categories()->first()->name }}</p>--}}
                    {{--                            <div>--}}

                    {{--                            </div>--}}
                    {{--                            <div class="d-flex align-items-center justify-content-center justify-content-sm-start border-top pt-3 pb-2 mt-3 text-nowrap">--}}
                    {{--                                @foreach($product->types as $type)--}}
                    {{--                                    <i class="fi-cash mt-n1 me-2 lead align-middle opacity-70"></i>--}}
                    {{--                                    {{ number_format($type->price) }}--}}
                    {{--                                @endforeach--}}

                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}



                         {{--  crad 1--}}
                    <div class="card mt-3 mb-3">
                        <div class="row  g-0 ">
                            <div class=" col-4 col-md-12 ">
                                <img src="{{ asset('assets/img/footer/f58803b0-1c68-11ee-83ca-55c0b655084a.jpg') }}" class="img-fluid rounded " alt="...">
                            </div>
                            <div class=" col-8 col-md-12">
                                <div class="card-body align-items-center justify-content-between">
                                    <p class="card-title text-center fs-5">نام محصول (موتور آسانسور xxxxxxxxxxxxxxxxxxxx)</p>

                                    <p class="card-text text-center"> قیمت<span>&nbsp25000</span></p>

                                    <div class="card-footer row m-auto d-flex align-items-center gy-1 justify-content-sm-center justify-content-md-between ">
                                        <button class="btn btn-light btn-sm col-12 col-md-2 border-dark m-auto "><i class="fi-trash text-center "></i></button>
                                        <button class="btn btn-outline-danger btn-sm col-12 col-md-8" type="button">خرید</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--  crad 2--}}
                    {{--                    <div class="card mt-3 mb-3">--}}
                    {{--                        <div class="row  ">--}}


                    {{--                            <div class="card-body row  d-flex justify-content-center align-items-center ">--}}
                    {{--                                <div class="col-4 col-md-12 d-flex flex-column justify-content-center">--}}
                    {{--                                    <img src="{{ asset('assets/img/footer/f58803b0-1c68-11ee-83ca-55c0b655084a.jpg') }}" class="img-fluid rounded-1 ps-2" alt="...">--}}
                    {{--                                </div>--}}

                    {{--                                <div class=" col-8 col-md-12 mt-3">--}}

                    {{--                                    <p class="card-title text-center ">نام محصول (موتور آسانسور xxxxxxxxxxxxxxxxxxxx)</p>--}}

                    {{--                                    <p class="card-text text-center mb-2"> قیمت<span>&nbsp25000</span></p>--}}
                    {{--                                </div>--}}
                    {{--                                <div class="card-footer row mb-0 d-flex align-items-center g-2 justify-content-sm-center justify-content-md-between ">--}}
                    {{--                                    <button class="btn btn-light btn-sm col-12 col-md-2 border-dark  "><i class="fi-trash text-center "></i></button>--}}
                    {{--                                    <button class="btn btn-outline-danger btn-sm col-12 col-md-8" type="button">خرید</button>--}}
                    {{--                                </div>--}}

                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}


                </div>

            @endforeach
        </div>



        <div class="d-grid  my-4 col-6 mx-auto col-md-12 pb-2">
            <button type="button" class="btn btn-outline-danger">حذف همه موارد</button>
        </div>

    @else
        <div class="d-flex text-center">
            <h4 class="mx-auto text-primary fw-normal fs-sm mt-5"> محصول مورد علاقه ای اضافه نشده است </h4>
        </div>
    @endif


</div>
