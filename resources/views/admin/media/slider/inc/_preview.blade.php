<div id="carouselExampleIndicators"
     class="carousel slide carousel-fade"
     @if($slider->hover == 0) data-bs-pause = "true" @endif
     @if($slider->autoplay == 'carousel') data-bs-ride="carousel" @endif data-bs-interval="{{ $slider->autoplay_interval }}" data-bs-touch="{{ $slider->touch }}" data-bs-wrap="{{ $slider->cycle }}">

    <ol class="carousel-indicators">
        @foreach ($slider->images as $index => $image)
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>

    <div class="carousel-inner" role="listbox">
        @foreach ($slider->images as $index => $image)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img class="d-block img-fluid w-100 img-thumbnail" src="{{ asset($image->file_path) }}" alt="Slide {{ $index + 1 }}" style="height: 350px">
                <!-- You can add any other content you want for each slide here -->
            </div>
        @endforeach
    </div>

    @if($slider->indicators == 1)

    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class=""></span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class=""></span>
    </a>
    @endif
</div>
