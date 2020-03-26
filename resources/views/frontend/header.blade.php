<!-- Start Main Top -->
@if(!empty($languages))
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="language-box">
                        <ul class="nav navbar-nav ml-10" data-in="fadeInDown" data-out="fadeOutUp">
                            <li class="dropdown">
                                <a href="#" class="" data-toggle="dropdown">{{ trans('lang.menu.languages') }}</a>
                                <ul class="dropdown-menu">
                                    @foreach($languages as $key => $val)
                                        <li><a href="{{ url('locale/'.$val['shortcode']) }}" ><span class="{{ $val['class'] }}"></span>&nbsp;&nbsp;{{ $key }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- End Main Top -->
    
<!-- Start Main Header -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ URL::to('/')}}"><img src="/frontend/images/logo.png" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            @if(count($menu) > 0)
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-10" data-in="fadeInDown" data-out="fadeOutUp">
                    @foreach($menu as $menuItem)
                        @if(!empty($menuItem['items']))
                            <li class="{{ $menuItem['li_class'] }}">
                                <a href="#" class="{{ $menuItem['a_class'] }}" data-toggle="dropdown">{{ trans($menuItem['text']) }}</a>
                                <ul class="dropdown-menu">
                                    @foreach($menuItem['items'] as $item)
                                        <li><a href="{{ $item['href'] }}">{{ $item['text'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <?php //echo $menuItem['text']; ?>
                            <li class="{{ $menuItem['li_class'] }}"><a class="{{ $menuItem['a_class'] }}" href="{{ $menuItem['href'] }}">{{ trans($menuItem['text']) }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            @endif
            
        <!-- Start Atribute Navigation -->
            <div class="attr-nav" id="my-cart">
                @include('frontend.my-cart')
            </div>
        <!-- End Atribute Navigation -->
        
        </div>
               
        <div class="side" id="cart-items">
            @include('frontend.cart-items')
         </div>
        
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Header -->