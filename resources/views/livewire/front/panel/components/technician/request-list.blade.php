<div wire:poll.visible.2s="refreshList">

    <div class="row d-flex justify-content-around">

        @foreach($request_list as $index => $request)

            @include('livewire.front.panel.components.technician._address_iframeModal')
            <div class="card col-md-5 mt-3 shadow-lg ">

                <ul class="list-group m-2" style="padding: 0 0 0 0 !important;">

                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        style="border:none !important;">
    <span>

        <button class="btn btn-success btn-xs" type="button" disabled>
  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
  <span class="visually-hidden">Loading...</span>
</button>

    </span>
                        <span class="badge bg-faded-primary">#{{ $request->referral }}</span>
                    </li>
                    <hr/>

                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        style="border:none !important;">
    <span class="text-justify fw-bold">

     {{ \Illuminate\Support\Str::limit($request->description,255) }}
    </span>
                        <p class="text-muted"></p>
                    </li>
                    <hr/>


                    <li class="list-group-item d-flex justify-content-between align-items-center"
                        style="border:none !important;">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn w-100 btn-outline-info" data-bs-toggle="modal"
                                data-bs-target="#mapmodal-{{$request->id}}">
                            مشاهده آدرس
                        </button>


                    </li>
                    <hr/>

                    <div class="d-flex justify-content-center mt-4 mx-auto">
                        <div class="d-flex">
                            <button type="button" class="w-50 me-2 btn btn-success"
                                    wire:confirm="درخواست تایید شود؟" wire:click.debounce.400ms="acceptRequest({{$request->id}},{{$request->referral}})">
                                <i class="fi-like me-1"></i>
                                تایید
                            </button>
                            <button wire:confirm="درخواست رد شود؟" wire:click.debounce.400ms="cancelRequest({{$request->id}})" type="button" class="btn btn-outline-primary" data-bs-toggle="button">
                                <i class="fi-dislike me-1"></i>
                                لغو
                            </button>
                        </div>
                    </div>


                </ul>


            </div>

        @endforeach

        @if($request_list->where('status','pending')->count() == 0)
            <div class="text-center mt-5">
                <p class="text-info fs-5 fw-bolder">درخواست فعالی وجود ندارد</p>
            </div>
        @endif


        <hr class="m-2">

    </div>
    <div class="accordion mt-3 shadow-lg rounded-3" id="accordion-requestlist">
        <div class="accordion-item" x-data="{ open: false }" x-init="$watch('open', value => { if(value) { $refs.collapse.classList.add('show'); } else { $refs.collapse.classList.remove('show'); } })">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" @click="open = !open" :aria-expanded="open" aria-controls="collapseOne">
                    سابقه درخواست
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" x-ref="collapse" :class="{ 'show': open }" aria-labelledby="headingOne" data-bs-parent="#accordion-requestlist">
                <div class="accordion-body">

                    <div class="table-responsive mt-1">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>شماره</th>
                                <th>زمان</th>
                                <th>ساختمان</th>
                                <th>وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($request_history as $index => $request)
                                <tr class="
                                @switch($request->status)
                                    @case('accepted') bg-faded-success border-success @break
                                    @case('cancelled') bg-faded-dark @break
                                    @case('rejected') bg-faded-danger @break
                                    @case('pending') bg-faded-warning @break
                                    @default bg-faded-primary
                                @endswitch
                            ">
                                    <th scope="row">{{ $index +1 }}</th>
                                    <td>{{ $request->referral }}</td>
                                    <td class="fs-xs text-waiting">{{ jdate($request->created_at)->toFormattedDateTimeString() }}</td>
                                    <td>{{ $request->building->builder_name}}</td>
                                    <td>{{ $request->getStatus() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
