<div class="col-md-7 col-lg-4">

    @if(\Illuminate\Support\Facades\Route::currentRouteName() == 'blogIndex')
        <div class="blog-widget widget-top">
            <a href="#"><img class="img-fluid" src="{{ asset('assets/images/atelpedia.jpeg') }}" alt="promo"></a>
        </div>


    @else
        <div class="blog-widget widget-top">
            <a href="#"><img class="img-fluid" src="{{ asset($post->images->first()->file_path) }}" alt="promo"></a>
        </div>

    @endif




    <div class="blog-widget">
        <h3 class="blog-widget-title">جست و جو</h3>
        <form class="blog-widget-form" method="get" action="{{ route('blogIndex') }}">
            <input name="search" type="text" placeholder="جستجو در دانشنامه">
            <button type="submit" class="icofont-search-1"></button>
        </form>
    </div>
    <div class="blog-widget">
        <h3 class="blog-widget-title">مطالب محبوب</h3>
        <ul class="blog-widget-feed">
            @foreach($best_posts->take(10) as $post)
                <li>
                    <a class="blog-widget-media" href="{{ route('blogSingle',['post' =>$post->id,'slug' => slugMaker($post->title)]) }}">
                        <img src="{{ asset($post->images->first()->file_path) }}" alt="blog-widget">
                    </a>
                    <h6 class="blog-widget-text">
                        <a href="{{ route('blogSingle',['post' =>$post->id,'slug' => slugMaker($post->title)]) }}">{{ $post->title }}</a>
                        <span> {{ jdate($post->created_at)->format('d F Y') }} </span>
                    </h6>
                </li>
            @endforeach

        </ul>
    </div>
    <div class="blog-widget">
        <h3 class="blog-widget-title">دسته بندی ها </h3>
        <ul class="blog-widget-category">
            @foreach($categories->load('posts')->take(10) as $category)
                <li><a href="{{ route('blogIndex',['cid' => $category->id,'category' => slugMaker($category->name)]) }}"> {{ $category->name }} <span>{{$category->posts->count()}}</span></a></li>
            @endforeach
        </ul>
    </div>

  <div class="blog-widget">
      <h3 class="blog-widget-title">تگ های محبوب</h3>
      <ul class="blog-widget-tag">
          @foreach(getPostTags()->take(15) as $tag)
          <li><a href="{{ route('blogIndex',['tid'=>$tag->id,'tag' =>slugMaker($tag->name)]) }}">{{ $tag->name }}</a></li>
          @endforeach
      </ul>
  </div>
    <div class="blog-widget">
        <h3 class="blog-widget-title">ما را دنبال کنید</h3>
        <ul class="blog-widget-social">
            <li><a href="#" class="icofont-facebook"></a></li>
            <li><a href="#" class="icofont-twitter"></a></li>
            <li><a href="#" class="icofont-linkedin"></a></li>
            <li><a href="#" class="icofont-instagram"></a></li>
        </ul>
    </div>

</div>