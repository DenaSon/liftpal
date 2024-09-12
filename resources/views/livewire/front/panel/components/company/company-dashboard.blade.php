<div>



    @if(!$active)
        @include('livewire.front.panel.components.company.registration-company')

    @elseif($active && auth()->user()->company->active == 0)
        <span class="text-center m-2">
 <div class="mt-2 alert alert-primary alert-dismissible fade show" role="alert">

  <span class="fw-bold">
      ثبت شرکت شما انجام شده و پس از استعلام توسط واحد فنی حساب کاربری شما فعالسازی می شود.
  </span>
     <p class="fw-normal mt-2 text-muted"> این فرآیند 1 تا 12 ساعت زمان‌بر خواهد بود </p>
     <p class="fw-lighter mt-2 text-muted">در صورت بروز هرگونه مشکل از طریق واحد پشتیبانی باما در ارتباط باشید</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

        </span>

        <div class="row">
            <x-front.card-counter text="کارشناس فنی" counter="{{ auth()->user()->company->technicians->count('id')  }}"
                                  type="success" icon="fi-user-plus"></x-front.card-counter>
            <x-front.card-counter text="ساختمان" counter="{{ auth()->user()->company->buildings->count('id')  }}"
                                  type="primary" icon="fi-building"></x-front.card-counter>
        </div>

    @else

        @include('livewire.front.panel.components.company.company-summary')

    @endif



</div>
