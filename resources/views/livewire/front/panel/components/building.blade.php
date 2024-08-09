<div>
    <a href="?page=building&action=create"> افزودن </a>


<hr>

@if(request()->input('action'))

    @include('livewire.front.panel.components.building-inc.create')

@else

@endif

</div>
