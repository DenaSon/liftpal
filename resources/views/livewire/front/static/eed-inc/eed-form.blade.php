<div class="card mb-4 shadow-lg">
    <div class="card-header">
        خطا یاب
    </div>
    <div class="card-body">
        <div class="my-2 mb-2" wire:ignore>
            <label for="errorCode" class="form-label text-muted"> کد خطا </label>
            <select class="select2-error select2" wire:model.live.debounce.1s="errorCode" style="width: 100%" id="errorCode">
                @foreach($errors as $error)
                    <option value="{{ $error->id }}">{{ $error->code }}</option>
                @endforeach

            </select>
        </div>


        <div class="text-center">
        <div wire:loading class="spinner-grow text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        </div>

        @if($this->result)

            <div class="alert alert-info mt-3" role="alert">
                <h4 class="alert-heading fs-sm">
                    خطا در دسته :   {{ $type }}
                </h4>
                <p>
                    {{ $result->description ?? '...' }}

                </p>
            </div>


        @endif

    </div>
</div>
