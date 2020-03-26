<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <h2>{{ $success }}</h2>
        </div>
        <div class="row">
            <p>{{ $message }}</p>
        </div>
        <hr>
        <div class="price-box-bar">
            <div class="cart-and-bay-btn">
                <a class="btn hvr-hover" data-fancybox-close="" href="{{ Url::to('/')}}">{{ trans('lang.shop_page.continue_shopping') }}</a>
            </div>
        </div>        
    </div>
</div>