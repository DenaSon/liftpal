<div>
    @section('css')

        <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">

    @endsection
    @include('livewire.front.home-inc.top-header')
    <livewire:front.cart.cart-modal/>
    @include('livewire.front.home-inc.header')


    <div class="container mt-5 mb-md-4 py-5">

        <div class="row">
            <!-- Page content-->
            <div class="col-lg-8 add-property">

                @include('livewire.calc.inc.top')

                @if($selectedCategory == 'cabinArea')

                    <livewire:calc.capacity.cabin-area calcName="مساحت کابین"/>


                @elseif($selectedCategory == 'elevatorCapacity' )
                    <livewire:calc.capacity.elevator-capacity calcName="ظرفیت آسانسور"/>
                @elseif($selectedCategory == 'reversebendangle')
                    <livewire:calc.suspension.reverse-bend-angle calcName="زاویه تقریبی خم معکوس (گرلس)"/>
                @else


                @endif

            </div>


            @include('livewire.calc.inc.sidebar')

            <div class="alert alert-danger" wire:offline>
                اتصال اینترنت خود را بررسی کنید
            </div>

        </div>
    </div>


    <hr class="divider w-75">
    @include('livewire.calc.inc.modals')
    @include('livewire.front.home-inc.footer')




    @section('js')
        <script data-navigate-once src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts/>
        <script data-navigate-once src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Main theme script-->
        <script data-navigate-once src="{{ asset('assets/js/theme.min.js') }}"></script>


    @endsection
</div>
