<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

<div class="h-100" data-simplebar>

@include('admin.panel.layouts.userbox')

<!--- Sidemenu -->
@can('admin-access')
    @include('admin.panel.layouts.inc.admin_sidebar')
@endcan

    @can('author')
        @include('admin.panel.layouts.inc.author_sidebar')
    @endcan



<!-- End Sidebar -->

<div class="clearfix"></div>

</div>
<!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
