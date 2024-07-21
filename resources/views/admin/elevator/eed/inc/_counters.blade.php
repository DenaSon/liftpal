<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-6 col-xl-3">
                <div class="card bg-pattern">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="avatar-md bg-blue rounded">
                                    <i class="mdi mdi-android-debug-bridge avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark my-1"><span data-plugin="counterup">{{ \App\Models\Error::count('id') }}</span></h3>
                                    <p class="text-muted mb-0 text-truncate">تعداد خطا</p>
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
                                    <i class="mdi  mdi-power-plug avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark my-1"><span data-plugin="counterup">

                     {{\App\Models\Error::where('type','electrical')->count('id') }}

                </span></h3>
                                    <p class="text-muted mb-0 text-truncate">الکتریکی</p>
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
                                    <i class="mdi mdi-wrench avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark my-1"><span data-plugin="counterup">
                {{\App\Models\Error::where('type','mechanical')->count('id') }}
                </span></h3>
                                    <p class="text-muted mb-0 text-truncate">مکانیکی</p>
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
                                    <i class="mdi mdi-information avatar-title font-22 text-white"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-end">
                                    <h3 class="text-dark my-1">
                <span data-plugin="counterup">
                    {{\App\Models\Error::where('type','other')->count('id') }}
                </span></h3>
                                    <p class="text-muted mb-0 text-truncate"> عمومی </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>



    </div>
<hr>

</div>
