<div>
    <div class="row">

        <x-front.card-counter class="mt-3" type="primary" icon="fi-building" text="ساختمان"
                              counter="{{ \App\Models\Building::count() }}"></x-front.card-counter>
        <x-front.card-counter class="mt-3" type="warning" icon="fi-grid" text="شرکت"
                              counter="{{ \App\Models\Company::count() }}"></x-front.card-counter>
        <x-front.card-counter type="success" icon="fi-user-plus" text="کارشناس"
                              counter="{{ \App\Models\User::whereRole('technician')->count() }}"></x-front.card-counter>
        <x-front.card-counter type="info" icon="fi-user-check" text="کارفرما"
                              counter="{{ \App\Models\User::whereRole('manager')->count() }}"></x-front.card-counter>


        @livewire('components.users-table',['role'=>'all','class' =>'table-hover table-hover','list_name' => 'لیست کاربران','card_class' => 'mt-3'])

       @livewire('components.requests-table',['class' => 'table-hover'])

    </div>

</div>
