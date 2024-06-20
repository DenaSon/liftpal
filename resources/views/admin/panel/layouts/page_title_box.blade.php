<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <form class="d-flex align-items-center mb-3">

                    <a href="{{ route('clearCache') }}" class="btn btn-primary btn-sm ms-2">
                        <i class="mdi mdi-autorenew"></i>
                    </a>
                    <a  class="btn btn-primary btn-sm ms-1"  data-bs-toggle="modal" data-bs-target="#help-modal">
                        <i class="mdi mdi-help"></i>
                    </a>
                </form>
            </div>
            <h4 class="page-title"> @yield('page-title') </h4>
        </div>
    </div>
</div>
<!-- end page title -->


<div id="help-modal" class="modal fade show" tabindex="-1" aria-modal="true" role="dialog" style="display: none;">
    <div class="modal-dialog  modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header border-0 bg-light">
                <div class="float-start"> راهنما </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                    <p class="text-start" style="line-height: 28px">




                    </p>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">بستن</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
