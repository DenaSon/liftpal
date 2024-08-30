        <div class="col-lg-3 col-md-1 mb-md-0 mb-4 mt-md-n5 order-sm-3">
        <!-- Sharing-->
        <div class="sticky-top py-md-5 mt-md-5">


        <!-- List group with icons and badges -->
        <ul class="list-group pt-md-5">


            <li class="list-group-item active">
            <span>
           دسته بندی مقالات
            </span>

            </li>


            @foreach($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center">
            <a wire:navigate href="{{ route('blogIndex',['cid'=>$category->id]) }}" class="text-decoration-none">
            {{ $category->name }}
            </a>
            <span class="badge bg-danger">{{ $category->posts->count() }}</span>
            </li>

            @endforeach
        </ul>

        </div>


        <div class="d-flex flex-md-column align-items-center my-2 mt-md-5 pt-md-2">

        <div class="d-md-none fw-bold text-nowrap me-2 pe-1">اشتراک گذاری</div>
        <a class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle mb-md-2 me-md-0 me-2"
           href="#" data-bs-toggle="tooltip" aria-label="Share with Facebook"
           data-bs-original-title="Share with Facebook"><i class="fi-facebook"></i></a><a
            class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle mb-md-2 me-md-0 me-2"
            href="#" data-bs-toggle="tooltip" aria-label="Share with Twitter"
            data-bs-original-title="Share with Twitter"><i class="fi-twitter"></i></a><a
            class="btn btn-icon btn-light-primary btn-xs shadow-sm rounded-circle mb-md-2 me-md-0 me-2"
            href="#" data-bs-toggle="tooltip" aria-label="Share with LinkedIn"
            data-bs-original-title="Share with LinkedIn"><i class="fi-linkedin"></i></a>
        </div>


        </div>
