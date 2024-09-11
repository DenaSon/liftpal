<div wire:init="loadMore" class="user-list">
    @foreach($users as $user)
        <div class="user-item">
            {{ $user->phone }}
        </div>
    @endforeach

    <!-- نمایش پیام بارگذاری داده ها در حین لود بیشتر کاربران -->
    @if($users->hasMorePages())
        <div wire:loading wire:target="loadMore" class="loader">
            بارگذاری بیشتر...
        </div>
    @endif
</div>


<script>
    document.addEventListener('scroll', function() {
        const {scrollTop, scrollHeight, clientHeight} = document.documentElement;
        if (scrollTop + clientHeight >= scrollHeight - 5) {
            @this.call('loadMore');
        }
    });
</script>
