<div>

    @include('livewire.front.panel.components.building-inc._building_modal')

    @if($building_list->count() > 0)

    @include('livewire.front.panel.components.building-inc._elevator_modal')

    @include('livewire.front.panel.components.building-inc._members_modal')
    @endif






    </div>
