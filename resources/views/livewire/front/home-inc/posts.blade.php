<hr class="mt-n1 mb-5 d-md-none">
<!-- Top offers (carousel)-->
<section class="container mb-5 pb-md-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h3 mb-0 ">مقالات آموزشی</h2><a wire:navigate class="btn btn-link fw-normal p-0"
                                                  href="{{ route('blogIndex') }}">مشاهده همه <i
                class="fi-arrow-long-left ms-2"></i></a>
    </div>
    <div class="tns-carousel-wrapper tns-controls-outside-xxl tns-nav-outside tns-nav-outside-flush mx-n2" dir="ltr">
        <div class="tns-carousel-inner row gx-4 mx-0 pt-3 pb-4"
             data-carousel-options="{&quot;items&quot;: 4, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;500&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;992&quot;:{&quot;items&quot;:4}}}">

            @foreach(getPosts() as $post)
                <!-- Item-->
                <div class="col">
                    <div class="card shadow-sm card-hover border-0 h-100">
                        <div class="card-img-top card-img-hover"><a wire:navigate class="img-overlay"
                                                                    href="{{ route('singleArticle',['id'=>$post->id,'slug'=>slugMaker($post->title)]) }}"></a>

                            <img src="{{ $post->images?->first()?->file_path ?? ''}}" alt="Image" height="265"
                                 style="height:265px;width:100%" width="100%">
                        </div>
                        <div class="card-body position-relative pb-3">
                            <h3 class="h6 mb-2 fs-base"><a class="nav-link stretched-link"
                                                           wire:navigate class="img-overlay"
                                                           href="{{ route('singleArticle',['id'=>$post->id,'slug'=>slugMaker($post->title)]) }}">{{ $post->title }}</a>
                            </h3>

                            <div class="small">{{ \Illuminate\Support\Str::limit($post->description,85,'...') }}</div>
                        </div>
                        <div
                            class="small card-footer d-flex align-items-center justify-content-center mx-3 pt-3 text-nowrap">

                            <i class="fi-user ms-1 mt-n1 fs-lg text-muted"></i> <span
                                class="small d-inline-block mx-1 px-2 fs-sm">   لیفت‌پال
                        </span>

                            <i class="fi-clock ms-1 mt-n1 fs-lg"></i>
                            <span class="small d-inline-block mx-1 px-2 fs-sm">

                        {{ jdate($post->created_at)->ago() }}

                    </span>

                        </div>
                    </div>
                </div>
                <!-- Item-->
            @endforeach

        </div>
    </div>
</section>
