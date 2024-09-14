
<div>

    @section('meta')

        <!-- SEO Meta Tags-->
        <meta name="description" content="{{ getSetting('meta_description') }}">
        <meta name="keywords" content="{{ getSetting('meta_keywords') }}">
        <meta name="author" content="Liftpal Systems">

    @endsection

        @section('schema')

            <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "Organization",
                  "name": "{{ getSetting('website_title') }}",
                  "url": "{{ url()->current() }}",
                  "logo": "https://liftpal.ir/assets/img/logo/logo.png",
                  "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "07433224561",
                    "contactType": "Customer Service",
                    "areaServed": "IR",
                    "availableLanguage": ["Persian", "English"]
                  },

                }
            </script>
            <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "BreadcrumbList",
                  "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home",
                    "item": "{{ url()->current() }}"
                  },{
                    "@type": "ListItem",
                    "position": 2,
                    "name": "مقالات آموزشی",
                    "item": "{{ route('blogIndex') }}"
                  }]
                }
            </script>



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




            <script data-navigate-onc src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

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
