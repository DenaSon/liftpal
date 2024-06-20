<div class="row">
<div class="col-md-6 col-xl-4">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <span class="mdi mdi-color-helper ms-1 me-1 text-primary"></span>
                <label for="template_color" class="form-label">رنگ قالب</label>
                <input class="form-control" id="template_color" type="color" name="template_color" value="{{ getSetting('template_color') }}" >
            </div>
        </div>
    </div>
</div>
</div> <!-- end card-->



    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <span class="mdi mdi-truck-fast ms-1 me-1 text-primary"></span>
                        <label for="fixed_shipping_cost" class="form-label"> هزینه ثابت حمل و نقل <small class="text-muted">(تومان)</small> </label>
                        <input  class="form-control" id="fixed_shipping_cost" type="number" name="fixed_shipping_cost" value="{{ getSetting('fixed_shipping_cost') ?? 0 }}" >
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-->



    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <span class="mdi mdi-truck-fast ms-1 me-1 text-primary"></span>
                        <label for="fixed_tax_rate" class="form-label"> هزینه ثابت مالیات <small class="text-muted">(درصد)</small> </label>
                        <input  class="form-control" id="fixed_tax_rate" type="number" name="fixed_tax_rate" value="{{ getSetting('fixed_tax_rate') ?? 0 }}" >
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-->






</div>















