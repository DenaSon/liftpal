<div
    id="usersTable"
    wire:scroll.debounce.200ms="loadMoreTriggered"
    style="height: 400px; overflow-y: auto;"
>
    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->profile?->name }} {{ $user->profile?->last_name }}</td>
                <td class="border px-4 py-2">{{ $user->phone }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if($users->hasMorePages())
        <div wire:loading wire:target="loadMoreTriggered">
            Loading more users...
        </div>
    @else
        <div class="text-center py-2">
            No more records to load.
        </div>
    @endif
</div>

<script>
    document.addEventListener('livewire:load', function () {
        let usersTable = document.getElementById('usersTable');
        usersTable.addEventListener('scroll', function () {
            if (usersTable.scrollTop + usersTable.clientHeight >= usersTable.scrollHeight) {
                Livewire.dispatch('loadMoreTriggered'); // Using dispatch for Livewire v3
            }
        });
    });
</script>
