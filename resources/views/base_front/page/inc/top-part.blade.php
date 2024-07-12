<!--=====================================
                  Single top Header
        =======================================-->


    <div class="container">

       <div class="single-header">
       <span class="single-cat">

            <a href="{{ route('home') }}"> آتل </a> <i class="fas fa-arrow-left"></i>

           <a href="{{ route('pageSingle',['page' => $page,'slug' => slugMaker($page->title)]) }}">    {{ $page->title }} </a> 

       </span>
       </div>

    </div>

<!--=====================================
           End Single top  Header
=======================================-->


