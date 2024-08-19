<!-- Modal -->
<div wire:ignore class="modal fade" id="mapmodal-{{$request->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" style="padding:0 1px 0 1px  !important;">
                @php
                $lat  = $request->building->latitude;
                $lng  = $request->building->longitude;
                $zoom = 16;
                $url = "https://api.neshan.org/v1/static?key=service.f0b032318487462a8dfa467aff93408a&type=neshan&zoom=$zoom&center=$lat,$lng&width=495&height=400"
                @endphp
                <p class="text-waiting ps-2 pe-2 pt-2">{{ $request->building->address }} ساختمان  {{ $request->building->builder_name }} پلاک  {{ $request->building->identify }}  </p>

                <iframe
                    width="100%"
                    height="400px"
                    style="border:0;overflow: hidden"
                    allowfullscreen="allowfullscreen"
                    loading="lazy"

                    referrerpolicy="no-referrer-when-downgrade"
                    src="{{$url}}">
                    درحال بارگذاری تصویر...
                </iframe>

            </div>

            <div class="modal-footer mt-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>

            </div>
        </div>
    </div>
</div>
