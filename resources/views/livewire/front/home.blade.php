
<div>

    @section('meta')

        <meta name="description" content="{{ getSetting('meta_description') }}">
        <meta name="keywords" content="{{ getSetting('meta_keywords') }}">
        <meta name="author" content="">

    @endsection

    @section('css')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/simplebar/dist/simplebar.min.css') }}"/>
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/nouislider/dist/nouislider.min.css') }}"/>
        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.css') }}"/>

        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">
    @endsection



    <livewire:front.cart.cart-modal/>

    @include('livewire.front.home-inc.header')

        @include('livewire.front.home-inc.hero')
        @include('livewire.front.home-inc.categories')
        @include('livewire.front.home-inc.services')
        @include('livewire.front.home-inc.posts')
        @include('livewire.front.home-inc.elevator-calc')
        @include('livewire.front.home-inc.logos')





    @include('livewire.front.home-inc.footer')

@section('js')
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script data-navigate-once src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
            <script data-navigate-onc src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js') }}"></script>
            <script data-navigate-onc src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
            <script data-navigate-onc src="{{ asset('assets/vendor/nouislider/dist/nouislider.min.js') }}"></script>
            <script data-navigate-onc src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>

            <script data-navigate-onc src="{{ asset('assets/js/theme.min.js') }}"></script>

@endsection
</div>
