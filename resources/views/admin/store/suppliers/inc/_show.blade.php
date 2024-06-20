<!-- Standard modal content -->
<div id="standard-modal-{{$supplier->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="standard-modalLabel"> نمایش اطلاعات تامین کننده : <span class= "font-14"> {{ $supplier->name }} </span> </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">







                <ul class="list-group">
                    <li class="list-group-item">
                        <strong class="fw-bold me-2"> وبسایت  :</strong>
                        <a rel="nofollow" target="_blank" href="{{ $supplier->website }}">   <span>{{ $supplier->website }}</span> </a>
                    </li>

                    <li class="list-group-item">
                        <strong class="fw-bold me-2"> آدرس  :</strong>
                           <span>{{ $supplier->address }}</span>
                    </li>



                    <li class="list-group-item">
                        <strong class="fw-bold me-2"> توضیحات  :</strong>
                        <span>{{ $supplier->description }}</span>
                    </li>

                </ul>






            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">بستن</button>

        </div><!-- /.modal-content -->
