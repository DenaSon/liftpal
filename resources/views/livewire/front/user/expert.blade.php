<div>


    @include('livewire.front.home-inc.header')
    @include('livewire.front.user.expert-inc.navigation')


    <section class="container mb-5 pb-1 ">
        <div class="row">
            <div class="col-12 col-md-7 mb-md-0 mb-4 mt-2 order-2 order-md-1">

                <h2 class="h4 mb-4 pb-4 border-bottom d-flex justify-content-between align-items-center">
                    <span>{{ $user?->profile?->name }} {{ $user->profile?->last_name }}</span>
                    <span class="fs-xs badge bg-success me-2 mb-3">تایید</span>
                </h2>


                <!-- Overview-->
                <div class="mb-3 pb-md-3">
                    <h3 class="h5 d-flex justify-content-center justify-content-md-start">رزومه کارشناس فنی</h3>
                    <p class="mb-1 line-h18 text-justify">
                        {{ $user->profile?->resume }}
                    </p>

                </div>

                <!-- Amenities-->
                <div class="mb-sm-3">
                    <h3 class="h5 d-flex justify-content-center justify-content-md-start">مهارت ها</h3>
                    <ul class="list-unstyled row row-cols-lg-3 row-cols-md-2 row-cols-1 gy-1 mb-1 text-nowrap">
                        @foreach($user?->skills as $skill)
                            <li class="col"><i
                                    class="fi-education mt-n1 me-2 fs-lg align-middle"></i> {{ $skill?->name }}</li>
                        @endforeach

                    </ul>
                </div>

                <hr class="mb-3">

                @include('livewire.front.user.expert-inc.comment-form')

                @foreach($comments_list as $index=> $comment)
                <div class="mb-4 pb-4 border-bottom">
                    <div class="d-flex justify-content-between mb-3 mt-4">
                        <div class="d-flex align-items-center pe-2">
                            <div class="ps-2 ">
                                <h6 class="fs-base mb-0 d-flex justify-content-center justify-content-md-start">
                                    {{ $comment?->username ?? '' }}
                                </h6>
                                <span class="star-rating mt-1">
                                    <i class="star-rating-icon fi-star-filled active"></i><i
                                        class="star-rating-icon fi-star-filled active"></i><i
                                        class="star-rating-icon fi-star-filled active"></i><i
                                        class="star-rating-icon fi-star-filled active"></i><i
                                        class="star-rating-icon fi-star-filled active"></i>
                                </span>
                            </div>
                        </div>
                        <span class="text-muted fs-sm">{{ jdate($comment?->created_at)->toFormattedDateString() }}</span>
                    </div>

                    <p class="text-justify"> {{ $comment?->text }} </p>

                    <div wire:poll.visible class="d-flex align-items-center">
                        <button wire:click.debounce.500ms="like({{$comment?->id}})" class="btn-like" type="button"><i class="fi-like"></i><span></span></button>
                        <div class="border-end me-1">&nbsp;</div>
                        <button  wire:click.debounce.500ms="dislike({{$comment?->id}})" class="btn-dislike" type="button">
                            <i class="fi-dislike"></i><span class="ms-2 @if($comment?->likes > 0) text-success @else text-danger @endif ">({{$comment->likes}})</span></button>
                    </div>
                </div>
                @endforeach

            </div>
            <!-- Sidebar-->
            @include('livewire.front.user.expert-inc.sidebar')
        </div>

    </section>


    @include('livewire.front.home-inc.footer')


</div>
