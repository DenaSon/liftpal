<div class="row mt-2">

    <div class="col-md-6 mb-2">
        <div class="card shadow-sm">
            <div class="card-body px-0">
                <div class="row p-0">
                    <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                        <div class="icon-box text-center ">
                            <div class="icon-box-media bg-faded-success text-success rounded-circle mx-auto ">
                                <i class="fi-folders"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mt-3">
                            <p class="mb-3 text-center">درخواست‌ها</p>
                            <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ auth()->user()->requests()->count() }}</span></h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="col-md-6 mb-2">
        <div class="widget-rounded-circle card">
            <div class="card-body shadow-sm">
                <div class="row p-0">
                    <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                        <div class="icon-box text-center ">
                            <div class="icon-box-media bg-faded-success text-success rounded-circle mx-auto">
                                <i class="fi-folder-plus"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mt-3">
                            <p class="mb-3 text-center">درخواست تایید شده</p>
                            <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ auth()->user()->requests()->whereStatus('accepted')->count() }}</span></h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6 mb-2">
        <div class="widget-rounded-circle card">
            <div class="card-body shadow-sm">
                <div class="row p-0">
                    <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                        <div class="icon-box text-center">
                            <div class="icon-box-media bg-faded-success text-success rounded-circle mx-auto">
                                <i class="fi-folder-x"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class=" mt-3">
                            <p class="mb-3 text-center">درخواست رد شده </p>
                            <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ auth()->user()->requests()->whereStatus('rejected')->count() }}</span></h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-6 mb-2">
        <div class="widget-rounded-circle card">
            <div class="card-body shadow-sm">
                <div class="row p-0">
                    <div class="col-6 d-flex align-items-center justify-content-center px-0 mx-0">
                        <div class="icon-box text-center ">
                            <div class="icon-box-media bg-faded-success text-success rounded-circle mx-auto">
                                <i class="fi-folder-off"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="text-end mt-3">
                            <p class=" mb-3 text-center">درخواست لغو شده</p>
                            <h6 class="text-dark mt-1 text-center text-waiting"><span>{{ auth()->user()->requests()->whereStatus('cancelled')->count() }}</span></h6>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
