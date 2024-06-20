<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="float-end d-none d-md-inline-block">
                    <div class="btn-group mb-2">

                    </div>
                </div>

                <h4 class="header-title mb-0" id="result">خلاصه فروش </h4>

                <div class="widget-chart text-center" dir="ltr">
                    <div id="total-revenue" class="mt-0" data-colors="#1abc9c"></div>


                    <h5 class="text-muted mt-0"> فروش امروز</h5>
                    <h2>{{ number_format($todaySales) }}</h2>

                   <br/> <p> فروش دیروز : {{ number_format($yesterdaySales) }} </p>

                    <div class="row mt-3">
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">سال گذشته</p>
                            <h4><i class="me-1"></i>{{  number_format($lastYearSales) }}</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">ماه گذشته</p>
                            <h4><i class="me-1"></i>{{ number_format($lastMonthSales) }}</h4>
                        </div>
                        <div class="col-4">
                            <p class="text-muted font-15 mb-1 text-truncate">هفته گذشته</p>
                            <h4><i class="me-1"></i>{{ number_format($lastWeekSales) }}</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col-->

    <div class="col-lg-8">
        <div class="card">
            <div class="card-body pb-2">
                <div class="float-end d-none d-md-inline-block">
                <div class="btn-group mb-2">

                       <button data-type ='day' type="button" class="btn btn-xs btn-light typeBtn">روزانه</button>
                       <button data-type ='week' type="button" class="btn btn-xs btn-light typeBtn">هفته ای</button>
                      <button data-type ='month' type="button" class="btn btn-xs btn-secondary typeBtn">ماهانه</button>
                      <button data-type ='year' type="button" class="btn btn-xs btn-secondary typeBtn">سالانه</button>
                  </div>
                </div>

                <h4 class="header-title mb-3">  تحلیل فروش</h4>

                <div dir="ltr">
                    <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>


                </div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col-->
</div>
