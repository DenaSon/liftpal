<!-- User box -->
@if(auth()->check())
<div class="user-box text-center">

    <img src="{{ asset( auth()->user()->profile->images->first()->file_path ?? 'admin/assets/images/users/user-4.jpg') }}" alt="user-img" title="" class="rounded-circle avatar-md">

    <div class="dropdown">
        <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown">
            {{ auth()->user()->profile->name ?? '' }} {{ auth()->user()->profile->last_name ?? ''   }}

        </a>
        <div class="dropdown-menu user-pro-dropdown">

            <!-- item-->
            <a href="{{ route('dashboard') }}" class="dropdown-item notify-item">
                <i class="fe-user me-1"></i>
                <span>حساب من</span>
            </a>

            <!-- item-->
            <a href="{{ route('setting') }}" class="dropdown-item notify-item">
                <i class="fe-settings me-1"></i>
                <span>تنظیمات</span>
            </a>


            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <i class="fe-log-out me-1"></i>
                <span>خروج</span>
            </a>

        </div>
    </div>
    <p class="text-muted">
      {{ auth()->user()->getRole() }}

    </p>
</div>
@endif
