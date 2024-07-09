<!--=====================================
                  Single top Header
        =======================================-->


    <div class="container">

       <div class="single-header">
       <span class="single-cat">

            <a href="{{ route('home') }}"> آتل </a> <i class="fas fa-arrow-left"></i>


           @if ($product->categories->isNotEmpty())
               @foreach ($product->categories as $category)
                   <a href="{{ route('indexByCategory',['category' => $category,'slug' => slugMaker($category->name)]) }}">
                       {{ $category->name }} </a>
                       @if (!$loop->last) <i class="fas fa-arrow-left"></i>  @endif
               @endforeach
           @endif

       </span>
       </div>


    </div>

<!--=====================================
           End Single top  Header
=======================================-->


