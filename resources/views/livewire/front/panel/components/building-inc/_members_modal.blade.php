<div class="border rounded shadow-sm p-4 mt-3">
<div class="container position-relative">
<div class="row justify-content-center">
<div class="col-md-6 d-flex justify-content-center">
<div class=" ps-2 text-center">
    <label class="form-label fw-bold"> اعضای ساختمان</label>
    <div id="skill-value">{{ $member_list->count() }} عضو ثبت شده</div>
</div>
</div>
</div>

</div>

<div class="container mt-3">


<!-- Button trigger modal -->
<button type="button" class="btn btn-success d-block w-100" data-bs-toggle="modal"
data-bs-target="#staticBackdrop">
<i class="fi-plus-circle me-1 fs-sm"></i>
افزودن عضو
</button>

<!-- Modal -->
<div wire:ignore class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
tabindex="-1"
aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
    <div class="modal-header ">
        <h1 class="modal-title fs-5 bg-soft-success" id="staticBackdropLabel">افزودن اعضای
            ساختمان</h1>
        <button type="button" class="btn-close me-0" data-bs-dismiss="modal"
                aria-label="Close"></button>
    </div>
    <div class="modal-body">


        <div class="col-12 mb-4">
            <select  wire:model="building_id" @if($building_list->count() == 1) hidden="hidden" @endif
                    class="form-select border border-primary" aria-label="Default select example">
                <option selected value="0">انتخاب ساختمان</option>
                @foreach($building_list as  $index => $building)
                    <option @if($building_list->count() == 1) selected
                            @endif wire:key="{{ $building->id }}"
                            value="{{ $building->id }}"> {{ $index+1 }} - ({{ $building->builder_name }}
                        )
                        <span
                            class="fs-xxs"> {{ \Illuminate\Support\Str::limit($building->address,25) }}</span>
                    </option>
                @endforeach

            </select>
        </div>


        <div class="form-floating col-12 mb-3">
            <input wire:model="full_name" type="text" class="form-control" id="floatingInput"
                   placeholder="نام و نام خانوادگی">
            <label for="floatingInput">نام و نام خانوادگی</label>
        </div>

        <div class="form-floating col-12 mb-3">
            <input wire:model="phone" type="number" class="form-control" id="floatingInput"
                   placeholder="شماره تماس">
            <label for="floatingInput">شماره تماس</label>
        </div>

        <div class="form-floating col-12 mb-3">
            <input wire:model="unit" type="text" class="form-control" id="floatingInput"
                   placeholder="شماره واحد">
            <label for="floatingInput">شماره واحد</label>
        </div>


        <div class="form-floating col-12 mb-4">
            <select wire:model="role" class="form-select" id="floatingSelect" aria-label="Default select example">

                <option value="owner">مالک</option>
                <option value="tenant">مستاجر</option>
                <option value="manager">مدیر</option>
                <option value="other">سایر</option>
            </select>
            <label for="floatingSelect">انتخاب نقش</label>
        </div>


    </div>
    <div class="modal-footer">
        <button wire:click.debounce.300ms="addMember" type="button" class="btn btn-success btn-xs w-25">
            ثبت
        </button>
        <button type="button" class="btn btn-primary btn-xs" data-bs-dismiss="modal">بستن</button>

    </div>
</div>
</div>
</div>


</div>

<div class="accordion mt-2" id="accordion-member">
<div class="accordion-item">
<h2 class="accordion-header" id="headingOneMember">
<button class="accordion-button text-success" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseOneMember" aria-expanded="true" aria-controls="collapseOneMember">
    مشاهده اعضا
</button>
</h2>
<div id="collapseOneMember" class="accordion-collapse collapse show" aria-labelledby="headingOneMember"
 data-bs-parent="#accordion-member">
<div class="accordion-body">
    <ul class="list-group">

        @foreach($member_list as $index => $member)
            <li wire:key="2" class="list-group-item d-flex justify-content-between align-items-center">
        <span>
        <i class="fi-user-check text-success me-2"></i>
        {{ $member->full_name }}
           <span class="text-muted fs-sm">
                از ساختمان
            {{ $member->building()->first()->builder_name }}
           </span>
        </span>
                <a href="#" class="" wire:click.debounce.250ms="removeMember('{{$member->id}}')"
                   onclick="event.preventDefault();">
                    <i class="btn-xs fi fi-trash"></i>
                </a>
            </li>
        @endforeach

    </ul>
</div>
</div>
</div>

</div>

</div>
@script
<script>
$wire.on('member_added', () => {
$('#staticBackdrop').modal('hide');

});

</script>
@endscript
