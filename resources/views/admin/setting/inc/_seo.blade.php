<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <span class="mdi mdi-format-title ms-1 me-1 text-primary"></span>
                        <label class="form-label" for="website_title">  عنوان سایت </label>
                        <input type="text" value="{{ getSetting('website_title') }}" id="website_title" name="website_title" class="form-control">
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
                        <span class="mdi mdi-text-box ms-1 me-1 text-primary"></span>
                        <label class="form-label" for="meta_description">  توضیحات متا </label>
                        <input type="text" value="{{ getSetting('meta_description') }}" id="meta_description" name="meta_description" class="form-control">
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
                        <span class="mdi mdi-file-word ms-1 me-1 text-primary"></span>
                        <label class="form-label" for="meta_keywords">  کلمات کلیدی متا </label>
                        <input type="text" value="{{ getSetting('meta_keywords') }}" id="meta_keywords" name="meta_keywords" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end card-->






    <!-- end card-->

</div> <!-- end row -->


