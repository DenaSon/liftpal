<section class="page-title gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <div class="breadcrumbs-wrap">
                    <h1 class="breadcrumb-title font-2">
                        {{ $page_title }}
                    </h1>
                    <nav class="transparent">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item"><a wire:navigate href="{{ route('home') }}">خانه</a></li>
                            <li class="breadcrumb-item active theme-cl" aria-current="page">
                                <a wire:navigate href="{{ route('contactUs') }}"> {{ $page_title }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>
</section>

