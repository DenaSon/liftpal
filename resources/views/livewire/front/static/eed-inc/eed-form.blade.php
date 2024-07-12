<div class="card mb-4 shadow-sm">
    <div class="card-header">
        خطا یاب
    </div>
    <form class="card-body" wire:submit.debounce.50="fetchError">
        <div class="my-2" wire:ignore>
            <label for="errorCode" class="form-label text-muted"> کد خطا </label>
            <select class="select2-error  select2 " wire:model="errorCode" style="width: 100%" id="errorCode">
                <option value="AL" disabled selected>کد خطا را وارد کنید</option>
                @foreach($errors as $error)
                    <option value="{{ $error->code }}">{{ $error->code }}</option>
                @endforeach

            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-primary d-block w-100 my-5">جستجو</button>
        </div>


        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading fs-lg">
                <span class="fs-lg">دسته‌ :</span>
                <span class="fs-sm">
                  مکانیکی
               </span>

            </h4>


            <p>
                {{ $result->description ?? '...' }}
            </p>

        </div>
    </form>
</div>
