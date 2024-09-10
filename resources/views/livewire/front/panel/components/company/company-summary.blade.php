<div class="row">
    <x-front.card-counter class="mt-3" text="کارشناس فنی" counter="{{ auth()->user()->company->technicians->count('id')  }}"
                          type="success" icon="fi-user-plus"></x-front.card-counter>

    <x-front.card-counter class="mt-3" text="ساختمان" counter="{{ auth()->user()->company->buildings->count('id')  }}"
                          type="primary" icon="fi-building"></x-front.card-counter>

</div>




@livewire('components.users-table', [
    'role' => 'technician',
    'class' => 'table-striped',
    'list_name' => 'لیست کارشناس'
])

@livewire('components.users-table', [
    'role' => 'manager',
    'class' => 'table-hover',
    'list_name' => 'لیست کارفرما'
])

@livewire('components.requests-table',
['class'=> 'table-striped'])
