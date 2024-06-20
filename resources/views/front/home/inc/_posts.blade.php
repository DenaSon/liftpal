<!--=====================================
                      BLOG PART START
        =======================================-->
<section class="section blog-part">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h3>دانشنامه  </h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-slider slider-arrow">

                    @foreach($posts as $index => $post)
                        <div class="blog-card">
                            <div class="blog-media">
                                <a  class="blog-img" href="{{ route('blogSingle',['post'=>$post,'slug' => slugMaker($post->title)]) }}">
                                    <img  class=" shadow-lg" style="height:250px;width: 350px" src="{{ $post->images->first()->file_path }}" alt="{{ $post->title }}" width="320" height="250">
                                </a>
                            </div>
                            <div class="blog-content">
                                <ul class="blog-meta">
                                    <li>
                                        <i class="fas fa-user"></i>
                                        <span>{{ $post->user->profile->name }} {{ $post->user->profile->last_name }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-calendar-alt"></i>
                                        <span> {{ jdate($post->created_at)->toFormattedDateString() }}</span>
                                    </li>
                                </ul>
                                <h4 class="blog-title">
                                    <a  class="" href="{{ route('blogSingle',['post'=>$post,'slug' => slugMaker($post->title)]) }}">{{ $post->title }}</a>
                                </h4>
                                <p class="blog-desc">
                                    {{ \Illuminate\Support\Str::limit($post->description ,89)  }}
                                </p>
                                <a class="blog-btn" href="{{ route('blogSingle',['post'=>$post,'slug' => slugMaker($post->title)]) }}">
                                    <span>بیشتر بخوانید</span>
                                    <i class="icofont-arrow-left"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach



                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-25">
                    <a title="مشاهده تمام مقالات" href="{{ route('blogIndex') }}" class="btn btn-outline">
                        <i class="fas fa-eye"></i>
                        <span>مشاهده دانشنامه</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--=====================================
              BLOG PART END
=======================================-->
