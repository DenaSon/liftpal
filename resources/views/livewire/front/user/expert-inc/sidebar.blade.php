<aside class=" col-lg-4 col-md-5 ms-lg-auto pb-1 order-1 order-md-2 ">
    <!-- Contact card-->
    <div class="card shadow mb-4 order-sm-1 ">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between"><a class="text-decoration-none" href="{{ route('singleExpert',['id'=>$user->id,'']) }}"><img
                        class="rounded-circle mb-2" src="{{ $user->images()->first()->file_path }}" width="60" alt="Avatar">
                    <h5 class="mb-1 d-md-none">{{ $user->profile?->name ?? ''}} {{ $user->profile?->last_name ?? '' }} </h5>
                    <div class="mb-1"><span class="star-rating"><i class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i
                                class="star-rating-icon fi-star-filled active"></i><i class="star-rating-icon fi-star-filled active"></i><i
                                class="star-rating-icon fi-star-filled active"></i></span><span class="me-1 fs-sm text-muted">({{ $user->comments->count() }} دیدگاه ثبت شده)
                        </span>
                    </div>

                    <p class="text-body">
                        {{ $user->profile?->education }}
                    </p></a>
                <div class="me-4 flex-shrink-0">
                    <a target="_blank" class="btn btn-icon btn-light-primary btn-xs shadow-lg rounded-circle ms-2 mb-2"  href="https://wa.me/{{$user->phone}}?text=Liftpal:"><i class="fi-whatsapp"></i></a>
                    <a class="btn btn-icon btn-light-primary btn-xs shadow-lg rounded-circle ms-2 mb-2" href="#"><i class="fi-instagram"></i></a>
                    <a class="btn btn-icon btn-light-primary btn-xs shadow-lg rounded-circle ms-2 mb-2" href="tel:{{$user?->phone}}"><i class="fi-phone"></i></a>

                </div>
            </div>
            <ul class="list-unstyled border-bottom mb-4 pb-4">
                <li><a class="nav-link fw-normal p-0" href="tel:{{$user?->phone}}"><i class="fi-phone mt-n1 me-2 align-middle "></i>{{ $user->formattedPhone
                }}</a>
                </li>
                @if($user->email)
                    <li><a class="nav-link fw-normal p-0" href="{{ $user?->email }}"><i class="fi-mail mt-n1 me-2 align-middle "></i>
                            {{ $user?->email }}
                        </a>
                </li>



                @endif

                @if($passedDays > 0 )
                    <li>
                        <a class="nav-link fw-normal p-0" href="#"><i class="fi-route mt-n1 me-2 align-middle "> </i> <span class="fs-sm">مدت همکاری :


                {{ $passedDays  }} روز </span>
                        </a>
                    </li>
                @endif

            </ul>
            <!-- Contact form-->
            <form class="needs-validation" novalidate="">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name">
                    <label for="floatingInput">نام و نام خانوادگی</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="floatingPassword" placeholder="number">
                    <label for="floatingPassword">شماره تلفن</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">پیام خود را وارد نمایید</label>
                </div>

                <button class="btn btn-lg btn-primary d-block w-100" type="submit">ارسال درخواست</button>
            </form>
        </div>
    </div>
    <!-- Location (Map)-->

    <div class="pt-2 half-height-mobile-sidebarexpert mb-1">
        <div class="position-relative mb-2 ">
            <img class="rounded-3 " src="{{ asset('assets/img/real-estate/single/map.jpg') }}" alt="Map">
            <div class="d-flex w-100 h-100 align-items-center justify-content-center position-absolute top-0 start-0">
                <a target="_blank" class="btn btn-primary stretched-link "
                   href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.6145424811048!2d-73.93999278406218!3d40.74850644331743!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2592979d4827f%3A0x3a5d8b3cf779f3b6!2s28%20Jackson%20Ave%2C%20Long%20Island%20City%2C%20NY%2011101%2C%20USA!5e0!3m2!1sen!2sua!4v1618074552281!5m2!1sen!2sua"
                   data-iframe="true" data-bs-toggle="lightbox"
                   lg-uid="lg1"><i class="fi-route me-2"></i>مسیریابی
                </a></div>
        </div>
        <p class="mb-0 fs-sm text-center">ایران، تهران میدان آزادی</p>
    </div>

</aside>
