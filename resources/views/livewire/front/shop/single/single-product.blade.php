<div>
    @section('css')
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/simplebar/dist/simplebar.min.css') }}"/>
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.css') }}"/>
        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">

    @endsection
    @include('livewire.front.home-inc.header')

    <livewire:front.cart.cart-modal wire:key="{{ \Illuminate\Support\Str::uuid() }}"/>

    @include('livewire.front.shop.inc.singleHead')

    <div class="container mt-0 mb-lg-5 mb-4 pt-0 pb-lg-5">
        <div class="row gy-5 pt-lg-2">
            <div class="col-lg-8 order-1">
                <hr class="mb-3">


                @include('livewire.front.shop.inc.singleDetails')
            </div>
            <!-- Sidebar with details-->
            <aside class="col-lg-4">
                <div class="ps-lg-4 order-2">


                    <div class="card border-0 bg-snow mb-2">
                        <div class="card-body">

                            @include('livewire.front.shop.inc.singleSlider')


                        </div>
                    </div>


                    <div  class="text-danger d-flex justify-content-center mb-2" >
                        <b wire:offline>اتصال به اینترنت  را بررسی کنید</b>
                    </div>

                    @if($product->types->count() > 1)


                    <div class="card border-0 bg-secondary mb-4">
                        <div class="card-body">

                            <form class="tab-pane fade show active" autocomplete="off" wire:submit="AddTypeCart">
                                <div class="mb-3 d-flex flex-wrap justify-content-between">

                                    @foreach($product->types as $type)
                                        <div class="form-check-inline mb-2" wire:key="{{$type->id}}">
                                            <input class="form-check-input inline" type="radio" id="types-{{$type->id}}"
                                                   wire:model="selectedType" value="{{ $type->id }}">
                                            <label class="form-check-label" for="types-{{$type->id}}"><b>{{ $type->name }}</b>
                                                <span class="text-info"> ({{ number_format($type->price) }}</span>
                                                <span class="small text-info">تومان)</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>


                            </form>

                        </div>
                    </div>
                    @endif

                    @php
                        $exist_cart =  \App\Models\Cart::whereProductId($product->id)->whereTypeId($product->types->first()->id ?? 1)->first()
                    @endphp

                    @if($product->types->count() == 1 && !$exist_cart)
                        <button wire:offline.attr="disabled" class="btn btn-lg btn-primary w-100 mb-3" wire:click="addSingleCart('{{ encrypt($product->id) }}')">
                            <i class="fi-cart"></i>
                            افزودن به سبد خرید
                        </button>
                    @elseif($exist_cart && $product->types->count() == 1)
                        <button wire:offline.attr="disabled" class="btn btn-lg btn-primary w-100 mb-3" wire:click="removeSingleCart('{{ encrypt($product->id) }}')">
                            <i class="fi-cart"></i>
                            حذف از سبد خرید
                        </button>
                    @elseif($product->types->count() > 1)

                        <button wire:offline.attr="disabled" class="btn btn-lg btn-primary w-100 mb-3" wire:click="addTypeCart('{{ encrypt($product->id) }}')">
                            <i class="fi-cart"></i>
                            افزودن به سبد خرید
                        </button>

                    @endif



                    <div class="card border-0 bg-secondary mb-4">
                        <div class="card-body">

                            <ul class="list-unstyled row row-cols-md-2 row-cols-1 gy-2 mb-0 text-nowrap">
                                <li class="col"><i class="fi-truck mt-n1 me-2 fs-lg align-middle"></i>تحویل سریع</li>
                                <li class="col"><i class="fi-security mt-n1 me-2 fs-lg align-middle"></i>پرداخت امن</li>
                                <li class="col"><i class="fi-star-filled mt-n1 me-2 fs-lg align-middle"></i> ضمانت اصالت</li>
                                <li class="col"><i class="fi-users mt-n1 me-2 fs-lg align-middle"></i>پشتیبانی </li>
                            </ul>

                        </div>
                    </div>
                    <!-- Post meta-->
                    <ul class="d-flex mb-4 list-unstyled fs-sm">
                        <li class="me-3 pe-3 border-end">آخرین بروزرسانی :
                            <b> {{ jdate($product->created_at)->ago() }} </b></li>
                        <li class="me-3 pe-3 border-end">شماره محصول: <b>{{ $product->sku }}</b></li>
                        <li class="me-3 pe-3">بازدید: <b>{{ $product->views }} نفر</b></li>
                    </ul>
                </div>
            </aside>



        </div>


    </div>



    @include('livewire.front.home-inc.footer')

    @section('js')
        <script data-navigate-once src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts/>

        <script data-navigate-once
                src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
        <script data-navigate-once
                src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>


    @endsection

</div>


