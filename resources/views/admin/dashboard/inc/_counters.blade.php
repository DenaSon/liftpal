<div class="row">


    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success border-success border">
                            <i class="mdi mdi-sale font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $todaySalesCount }}</span></h3>
                            <p class="text-muted mb-1 text-truncate"> فروش امروز</p>
                        </div>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
        <!-- end widget-rounded-circle-->
    </div>

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-primary border-primary border">
                            <i class="mdi mdi-plus-box-multiple-outline font-22 avatar-title text-primary"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">

                            <h3 class="text-dark mt-1"><span data-plugin="counterup"> {{ number_format($salesSum) }} </span>
                           
                            </h3>
                            <p class="text-muted mb-1 text-truncate">مجموع </p>
                        </div>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
        <!-- end widget-rounded-circle-->
    </div>
    <!-- end col-->



    <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-info border-info border">
                            <i class="fe-bar-chart-line- font-22 avatar-title text-info"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{round($conversionRate,2)}}</span>%</h3>
                            <p class="text-muted mb-1 text-truncate">نرخ تبدیل</p>
                        </div>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
        <!-- end widget-rounded-circle-->
    </div>
    <!-- end col-->

    <div class="col-md-6 col-xl-3">
        <div class="widget-rounded-circle card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning border-warning border">
                            <i class="mdi mdi-account-group font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup"> {{ $customers }} </span></h3>
                            <p class="text-muted mb-1 text-truncate">مشتری</p>
                        </div>
                    </div>
                </div>
                <!-- end row-->
            </div>
        </div>
        <!-- end widget-rounded-circle-->
    </div>
    <!-- end col-->
</div>
