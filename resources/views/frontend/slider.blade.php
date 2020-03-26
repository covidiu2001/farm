    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        @if(count($sliders) > 0)
            <ul class="slides-container">
                @foreach($sliders as $slider)
                <li class="text-center">
                    <img src="{{ URL::to(asset("/storage/frontend/images/" . $slider->image)) }}" alt="">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <h1 class="m-b-20"><strong>{{ $slider->title }}</strong></h1>
                                <p class="m-b-40">{{ $slider->description }}</p>
                                <p><a class="btn hvr-hover" href="#">{{ $slider->button_text }}</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </ul>
        @endif
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->