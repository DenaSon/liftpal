<div class="col-md-6 mb-2 {{$class ?? ''}}">
    <div class="card shadow-sm">
        <div class="card-body px-0">
            <div class="row p-0">
                <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                    <div class="icon-box text-center ">
                        <div class="icon-box-media bg-{{$type}} text-white rounded-circle mx-auto ">
                            <i class="{{$icon ?? 'fi-user'}}"></i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mt-3">
                        <p class="mb-3 text-center">{{ $text }}</p>
                        <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ $counter }}</span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
