<!-- Start Categories  -->
@if(count($categories) > 0)
<div class="categories-shop" id="categories">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>{{ trans('lang.front_page.category_products_header') }}</h1>
                </div>
            </div>
        </div>
        
        <div class="row">
            @foreach($categories as $category)
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="shop-cat-box">                    
                    <img src="{{ URL::to(asset("/storage/frontend/images/" . $category->image)) }}" class="img-fluid"></img>
                    <?php $name = '.' . str_replace(' ', '-', mb_strtolower($category->name)); ?>
                    <a class="btn hvr-hover" href="{{ URL::to('displayCategory/' . $category->id) }}">{{  trans('lang.front_page.products' . $name)  }}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
<!-- End Categories -->