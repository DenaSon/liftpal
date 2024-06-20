<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6 col-xl-3">
                <div class="card bg-pattern">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-md bg-blue rounded">
                                    <i class="mdi mdi-order-numeric-ascending avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark my-1"><span data-plugin="counterup">{{\App\Models\Post::count('id') }}</span></h3>
                                    <p class="text-muted mb-0 text-truncate">سفارشات</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->

            <div class="col-lg-6 col-xl-3">
                <div class="card bg-pattern">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-md bg-success rounded">
                                    <i class="mdi mdi-calendar-month avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark my-1"><span data-plugin="counterup">

{{\App\Models\Post::whereBetween('created_at', [ now()->subMonth(), now()])->count('id') }}

</span></h3>
                                    <p class="text-muted mb-0 text-truncate">  ماه </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
            <div class="col-lg-6 col-xl-3">
                <div class="card bg-pattern">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-md bg-danger rounded">
                                    <i class="mdi mdi-view-week-outline  avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark my-1"><span data-plugin="counterup">
{{\App\Models\Post::whereBetween('created_at', [ now()->subWeek(), now()])->count('id') }}
</span></h3>
                                    <p class="text-muted mb-0 text-truncate"> هفته </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->


            <div class="col-lg-6 col-xl-3">
                <div class="card bg-pattern">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-md bg-warning rounded">
                                    <i class="mdi mdi-calendar-today avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark my-1">
<span data-plugin="counterup">
{{\App\Models\Post::whereBetween('created_at', [ now()->subDays(), now()])->count('id') }}
</span> </h3>
                                    <p class="text-muted mb-0 text-truncate">  امروز </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
