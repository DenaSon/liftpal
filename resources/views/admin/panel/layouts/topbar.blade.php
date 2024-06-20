
<!-- body start -->

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": false}'>
<script src="{{ asset('vendor/sweetalert/sweetalert2.all.js') }}"></script>
@include('sweetalert::alert')
<!-- Begin page -->
<div id="wrapper">

<!-- Topbar Start -->
<div class="navbar-custom">
<div class="container-fluid">
<ul class="list-unstyled topnav-menu float-end mb-0">

    <!--
<li class="d-none d-lg-block">
<form class="app-search">



</form>
</li> -->

<li class="dropdown d-inline-block d-lg-none">
<a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
<i class="fe-search noti-icon"></i>
</a>
<div class="dropdown-menu dropdown-lg dropdown-menu-end p-0">
<form class="p-3">
    <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
</form>
</div>
</li>

<li class="dropdown d-none d-lg-inline-block">
<a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
<i class="fe-maximize noti-icon"></i>
</a>
</li>

<li class="dropdown d-none d-lg-inline-block topbar-dropdown">
<a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
<i class="fe-grid noti-icon"></i>
</a>
<div class="dropdown-menu dropdown-lg dropdown-menu-end">

<div class="p-lg-1">
    <div class="row g-0">
        <div class="col">
            <a class="dropdown-icon-item" href="{{ route('products.index') }}">
                <span class="mdi mdi-shopping-outline font-28 text-success"></span>
                <span class="font-13"> محصولات</span>
            </a>
        </div>
        <div class="col">
            <a class="dropdown-icon-item" href="{{ route('orders.index') }}">
                <span class="mdi mdi-order-numeric-ascending font-28 text-info"></span>
                <span> سفارشات</span>
            </a>
        </div>
        <div class="col">
            <a class="dropdown-icon-item" href="{{ route('customers.index') }}">
                <span class="mdi mdi-account-group-outline font-28 text-pink"></span>
                <span>مشتری ها</span>
            </a>
        </div>
    </div>

    <div class="row g-0">
        <div class="col">
            <a class="dropdown-icon-item" href="{{ route('log-system') }}">
               <span class="mdi mdi-alert-circle-check-outline font-28 text-danger"></span>
                <span> هشدارها </span>
            </a>
        </div>



    </div>
</div>

</div>
</li>
    <!-- item
<li class="dropdown d-none d-lg-inline-block topbar-dropdown">
<a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
<img src="{{ asset('admin/assets/images/flags/us.jpg') }}" alt="user-image" height="16">
</a>
<div class="dropdown-menu dropdown-menu-end">


<a href="javascript:void(0);" class="dropdown-item">
    <img src="" alt="user-image" class="me-1" height="12"> <span class="align-middle">آلمانی</span>
</a>


</div>
</li> -->

<li class="dropdown notification-list topbar-dropdown">
<a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
<i class="fe-bell noti-icon"></i>
<span class="badge bg-danger rounded-circle noti-icon-badge">
@if( \App\Models\Notification::where('channel','panel')->count() > 0) <span class="fe-alert-triangle"></span> @endif
</span>
</a>
<div class="dropdown-menu dropdown-menu-end dropdown-lg">

<!-- item-->
<div class="dropdown-item noti-title">
    <h5 class="m-0">
            <span class="float-end">
        <a href="" class="text-dark">
              <small>حذف همه</small>
        </a>
    </span>اطلاع
    </h5>
</div>

<div class="noti-scroll" data-simplebar>

    <!-- item-->
    @foreach(\App\Models\Notification::orderByDesc('created_at')->where('channel','panel')->take(5) ->get() as $notification)

    <a href="javascript:void(0);" class="dropdown-item notify-item active mt-1">
        <div class="notify-icon">
            <img src="{{ asset('admin/assets/images/users/system.png') }}" class="img-fluid rounded-circle" alt="" /> </div>
        <p class="notify-details">{{ $notification->subject }}</p>
        <small class="small">  {{ jdate($notification->created_at)->toTimeString() }} </small>
        <p class="text-muted mb-0 user-msg">
            <small>{{ $notification->content }}</small>
        </p>
    </a>


    @endforeach

</div>

<!-- All-->
<a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
    مشاهده همه
    <i class="fe-arrow-right"></i>
</a>

</div>
</li>

<li class="dropdown notification-list topbar-dropdown">
<a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">

        @if(auth()->check())
        <img src="{{ asset( auth()->user()->profile->images->first()->file_path ?? 'admin/assets/images/users/user-4.jpg') }}" alt="user-img" title="" class="rounded-circle avatar-md">
        @endif



<span class="pro-user-name ms-1">
      @if(auth()->check())
     {{ auth()->user()->profile->name ?? auth()->user()->profile->phone ?? "" }}
    @endif
    <i class="mdi mdi-chevron-down"></i>
</span>
</a>
<div class="dropdown-menu dropdown-menu-end profile-dropdown ">
<!-- item-->
<div class="dropdown-header noti-title">
    <h6 class="text-overflow m-0">
        @if(auth()->check())
        @if(auth()->user()->role == 'admin')
            مدیر کل
        @elseif(auth()->user()->role == 'visitor')
            ویزیتور
        @elseif(auth()->user()->role == 'stock')
            انباردار
        @elseif(auth()->user()->role == 'author')
            نویسنده
        @else
            کاربر
        @endif  </h6>
    @endif
</div>

<!-- item-->
<a href="javascript:void(0);" class="dropdown-item notify-item">
    <i class="fe-user"></i>
    <span> حساب من </span>
</a>

<!-- item-->
<a href="{{ route('setting') }}" class="dropdown-item notify-item">
    <i class="fe-settings"></i>
    <span>تنظیمات</span>
</a>

<!-- item-->
<a href="javascript:void(0);" class="dropdown-item notify-item">
    <i class="fe-lock"></i>
    <span>صفحه قفل</span>
</a>

<div class="dropdown-divider"></div>

<!-- item-->
    <form action="{{ route('logout') }}" method="post" id="logout-form">
        @csrf

    </form>
<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
    <i class="fe-log-out"></i>
    <span>خروج</span>
</a>

</div>
</li>

<li class=" notification-list">
<a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
<i class="fe-settings noti-icon"></i>
</a>
</li>

</ul>

<!-- LOGO -->
<div class="logo-box">
<a href="index.html" class="logo logo-dark text-center">
<span class="logo-sm">
<img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="" height="22">
    <!-- <span class="logo-lg-text-light">UBold</span> -->
</span>
<span class="logo-lg">
<img src="{{ asset('admin/assets/images/logo-dark.png') }}" alt="" height="20">
<!-- <span class="logo-lg-text-light">U</span> -->
</span>
</a>

<a href="{{ route('dashboard') }}" class="logo logo-light text-center">
<span class="logo-sm">
<img src="{{ asset('admin/assets/images/logo-sm.png') }}" alt="" height="22">
</span>
<span class="logo-lg">
<img src="{{ asset('admin/assets/images/logo-light.png') }}" alt="" height="20">
</span>
</a>
</div>

<ul class="list-unstyled topnav-menu topnav-menu-left m-0">
<li>
<button class="button-menu-mobile waves-effect waves-light">
<i class="fe-menu"></i>
</button>
</li>

<li>
<!-- Mobile menu toggle (Horizontal Layout)-->
<a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
<div class="lines">
    <span></span>
    <span></span>
    <span></span>
</div>
</a>
<!-- End mobile menu toggle-->
</li>

<li class="dropdown d-none d-xl-block">
<a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
ایجاد
<i class="mdi mdi-chevron-down"></i>
</a>




<div class="dropdown-menu">
<!-- item-->
<a href="{{ route('products.create') }}" class="dropdown-item">
    <i class="mdi mdi-plus"></i>
    <span>  محصول </span>
</a>


    <!-- item-->
    <a href="{{ route('categories.index') }}" class="dropdown-item">
        <i class="mdi mdi-plus"></i>
        <span>دسته </span>
    </a>

    <!-- item-->
    <a href="{{ route('posts.create') }}" class="dropdown-item">
        <i class="mdi mdi-plus"></i>
        <span>  مقاله </span>
    </a>


<!-- item-->
<a href="{{ route('page.create') }}" class="dropdown-item">
    <i class="mdi mdi-plus"></i>
    <span>  صفحه</span>
</a>


    <!-- item-->
    <a href="{{ route('brands.index') }}" class="dropdown-item">
        <i class="mdi mdi-plus"></i>
        <span> برند</span>
    </a>





</div>
    <li class="d-none d-xl-block">

    <li>
        <a class="nav-link  waves-effect waves-light" href="{{ route('home') }}">
           مشاهده سایت 
            <i class="mdi mdi-home"></i>
        </a>

    </li>

</ul>
<div class="clearfix"></div>
</div>
</div>
<!-- end Topbar -->
