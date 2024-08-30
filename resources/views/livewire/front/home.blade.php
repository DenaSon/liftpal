
<div>

    @section('meta')

        <!-- SEO Meta Tags-->
        <meta name="description" content="{{ getSetting('meta_description') }}">
        <meta name="keywords" content="{{ getSetting('meta_keywords') }}">
        <meta name="author" content="Liftpal Systems">

    @endsection

    @push('styles')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/tiny-slider/dist/tiny-slider.css') }}"/>

    @endpush


        @include('livewire.front.home-inc.header')
        @include('livewire.front.home-inc.hero')
        @include('livewire.front.home-inc.categories')
        @include('livewire.front.home-inc.services')
        @include('livewire.front.home-inc.posts')
        @include('livewire.front.home-inc.elevator-calc')
        @include('livewire.front.home-inc.logos')


    @include('livewire.front.home-inc.footer')

@section('js')

            <script data-navigate-onc src="{{ asset('assets/vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>

@endsection
        @script
        <script>


            $wire.on('login-action', () => {

                var loginModal = new bootstrap.Modal(document.getElementById('signin-modal'));
                loginModal.show();

            });
        </script>

        @endscript
</div>
