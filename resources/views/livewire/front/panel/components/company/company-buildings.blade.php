<div>
    <div class="card mt-3 shadow-lg'">


        <div class="d-flex justify-content-between">
        <span class="m-1 pt-2 pe-2 ps-2 fw-bold">
            <i class="fi-building me-2"></i>
         ساختمان های مرتبط با شرکت   {{ Auth::user()->company->first()->name }}
        </span>
            <span class="m-1 pt-2 pe-2 ps-2">
                <span class="badge bg-faded-info fw-lighter fs-sm text-waiting"> {{ $buildings?->count() ?? '0' }} </span>
            </span>

        </div>
        <hr class="w-75 text-secondary">

        <div class="table-responsive mt-3">

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ساختمان</th>
                    <th> مالک </th>
                    <th> مدیر </th>
                    <th>شماره مالک</th>
                    <th>شماره مدیر</th>
                    <th> تعداد کارشناس </th>
                    <th>زمان ثبتنام</th>
                </tr>
                </thead>
                <tbody>

                @foreach($buildings as $building)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                            {{ $building->builder_name}}
                            </td>
                        <td>
                            {{ $building->owner->profile?->name }} {{ $building->owner->profile?->last_name }}
                        </td>
                        <td>
                            {{ $building->manager_name }}
                        </td>

                        <td>
                            {{ $building->owner->phone }}
                        </td>
                        <td>
                            {{ $building->emergency_contact }}
                        </td>

                        <td>
                             {{ $building->companies?->first()->technicians->count() }} نفر
                        </td>

                        <td>
                            {{ jdate($building->pivot->created_at)->toFormattedDateString() }}
                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination">
            {{ $buildings->links() }}
        </div>

        @if($buildings->isEmpty())
            <span class="text-center text-info p-3 m-3">ساختمانی وجود ندارد</span>
        @endif
    </div>
</div>
