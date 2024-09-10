<div>
    <div class="card {{ $card_class ?? 'mt-3 shadow-lg' }}" id="paginated-requests">

        <div class="d-flex justify-content-between">
        <span class="m-1 pt-2 pe-2 ps-2 fw-bold">
            <i class="fi-list me-2"></i>
          لیست درخواست‌ها
        </span>
            <span class="m-1 pt-2 pe-2 ps-2">
                <span class="badge bg-faded-info fw-lighter fs-sm text-waiting"> {{ $requests?->count() ?? '0' }} </span>
            </span>

        </div>
        <hr class="w-75 text-secondary">
    <div class="table-responsive mt-3">

        <table class="table {{ $class }}">
            <thead>
            <tr>
                <th>#</th>
                <th>شماره ارجاع</th>
                <th>کارفرما</th>
                <th> ساختمان</th>
                <th>شرکت</th>
                <th>کارشناس</th>
                <th>وضعیت</th>

                <th>زمان </th>
            </tr>
            </thead>
            <tbody>

            @foreach($requests as $request)
                @if($request->status == 'accepted')
                    <tr class="bg-success" style="color: #FFFFFF">
                        @else
                    <tr>
                @endif


                    @if($request->has('building'))

                        <th scope="row">{{ $loop->iteration }}</th>
                        <td> {{ $request?->referral }}</td>
                        <td> {{ $request?->owner->profile?->name }} {{ $request->owner->profile?->last_name }}</td>
                        <td> {{ $request?->building->builder_name }}</td>
                        <td> {{ $request?->building->companies->first()->name}}</td>
                        <td> {{ $request?->technician->profile?->name }} {{ $request->technician->profile?->last_name}}</td>
                        <td> {{ $request->getStatus()  }}</td>
                        <td class="fs-xs small"> {{ jdate($request?->created_at)->ago() }}</td>

                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $requests->links(data: ['scrollTo' => '#paginated-requests']) }}
    </div>

    @if($requests->isEmpty())
        <span class="text-center text-info p-3 m-3">درخواستی وجود ندارد</span>
    @endif
</div>
</div>
