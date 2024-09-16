@section('schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BlogPosting",
            "headline": "{{ $post->title }}",
        "image": [
            "{{ asset($post->images->first()->file_path) }}"
        ],
        "datePublished": "{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d\TH:i:sP') }}",
        "dateModified": "{{ \Carbon\Carbon::parse($post->updated_at)->format('Y-m-d\TH:i:sP') }}",
        "author": [{
            "@type": "Person",
            "name": "{{ $post->profile->name ?? ''  }} {{ $post->profile->last_name ?? '' }}"
        }]
    }
    </script>
@endsection
@section('js')
    <link rel="canonical" href="{{ route('singleArticle',['id'=>$post->id,'slug'=>slugMaker($post->title)]) }}">
    <meta property="og:site_name" content="{{ getSetting('website_title') }}">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:type" content="product">
    <meta property="og:image" content="{{ asset($post->images->first()->file_path) }}">
    <meta property="og:url"
          content="{{ route('singleArticle',['id' => $post->id,'slug' => slugMaker($post->title)]) }}">
    <meta property="og:description" content="{{ $post->description }}">
    <meta property="og:locale" content="fa_IR">
    <meta name="keywords" content="{{ implode(', ', $post->tags->pluck('name')->toArray()) ?? ''}}">
    <meta name="description" content="{{ $post->description ?? ''}}">
    <!-- AUTHOR META -->
    <meta name="author" content="{{ $post->profile->name ?? ''}} {{ $post->profile->last_name ?? ''}} }}">
    <meta name="email" content="{{ $post->user->email ?? '' }}">

@endsection

@section('css')

    <link rel="stylesheet" media="screen" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="stylesheet" media="screen" href="{{ asset('assets/vendor/simplebar/dist/simplebar.min.css') }}"/>

@endsection

<div class="row">
    <div class="col-lg-8">
        <nav class="mb-3 pt-md-2 d-flex" aria-label="Breadcrumb">
            <ol class="breadcrumb text-start">
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                <li class="breadcrumb-item"><a wire:navigate href="{{ route('blogIndex') }}">مقالات</a></li>
                <li class="breadcrumb-item active" aria-current="page">


                </li>
            </ol>
        </nav>
        <div class="mb-4">
            <h1 class="h2 mb-0 mt-3">{{ $post->title }}</h1>

        </div>

        <div class="mb-4 pb-1">
            <ul class="list-unstyled d-flex flex-wrap mb-0 text-nowrap">
                <li class="me-3"><i
                        class="fi-calendar-alt me-2 mt-n1 opacity-60"></i> {{ jdate($post->created_at)->format('d F Y') }}
                </li>
                <li class="me-3 border-end"></li>
                <li class="me-3"><i
                        class="fi-clock me-2 mt-n1 opacity-60"></i> {{ getArticleReadTime($post->content,600) ?? 1 }}
                    دقیقه زمان برای مطالعه
                </li>
                <li class="me-3 border-end"></li>
                <li class="me-3"><a class="nav-link-muted" href="#comments" data-scroll=""><i
                            class="fi-chat-circle me-2 mt-n1 opacity-60"></i>{{ $post->comments->where('status','published')->count() }}
                        دیدگاه</a></li>
            </ul>
        </div>
    </div>

    <div class="col-lg-4 text-lg-start text-center">
        <img class="img-thumbnail" src="{{ asset($post->images->first()->file_path) }}" alt="{{ $post->title }}"
             height="180" width="290"/>
    </div>


</div>
