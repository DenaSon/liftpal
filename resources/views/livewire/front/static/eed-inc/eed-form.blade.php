



<div class="card mb-4 shadow-sm">
    <div class="card-header">
        خطا یاب
    </div>
    <div class="card-body">
        <div class="my-2">
            <label for="errorCode" class="form-label text-muted"> کد خطا </label>
            <select class="select2-error  select2 " wire:model="errorCode" style="width: 100%" id="errorCode">
                <option value="AL" disabled selected>کد خطا</option>
                <option value="WY">Miloo</option>
                <option value="WY">Mili</option>
                <option value="WY">MiliLo</option>
            </select>
        </div>

        <div>
            <button type="button" class="btn btn-primary d-block w-100 my-5">جستجو</button>
        </div>


        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">توضیح خطا</h4>
            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>

        </div>
    </div>
</div>