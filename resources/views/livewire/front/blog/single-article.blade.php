<div>

    <livewire:front.cart.cart-modal/>
    @include('livewire.front.home-inc.header')

    <article class="container mt-5 mb-md-4 py-5" id="{{ $post->id }}">

        @include('livewire.front.blog.inc.top')


        <div class="row">

            @include('livewire.front.blog.inc.sidebar')

            <div class="col-lg-9 col-md-10 mt-4  ">
                <div class="card">


                    <div class="card-body article-wrap text-justify">

                        {!! $post->content !!}
                    </div>


                    <div class="card-footer">


                        <div class="fw-bold text-nowrap mb-2 me-2 pe-1"></div>
                        <div class="d-flex flex-wrap">

                            @foreach($post->tags as $tag)
                                <a wire:key="{{ $tag->id }}"
                                   class="btn btn-xs btn-outline-secondary rounded-pill fs-sm fw-normal me-2 mb-2"
                                   href="{{ route('blogIndex',['tid'=>$tag->id]) }}">{{ $tag->name }}</a>
                            @endforeach

                        </div>

                    </div>
                </div>
                <br/>

                <!-- Comments-->
                @include('livewire.front.blog.inc.comments')
            </div>
        </div>


    </article>


    @include('livewire.front.home-inc.footer')

    @section('js')
        <script data-navigate-once  src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts/>
        <script data-navigate-once  src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script data-navigate-once  src="{{ asset('assets/js/theme.min.js') }}"></script>

    @endsection
</div>
