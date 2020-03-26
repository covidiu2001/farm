<!-- Start About Page  -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="banner-frame"> <img class="img-fluid" src="{{ URL::to(asset("/storage/frontend/images/" . $category->image)) }}" alt="" /></div>
            </div>
            <div class="col-lg-8">
                {!! Form::hidden('cat_id', $category->id, array('id' => 'cat_id')) !!}
                
                {!! Form::hidden('min_price', $min_price, array('id' => 'min_price')) !!}
                {!! Form::hidden('max_price', $max_price, array('id' => 'max_price')) !!}
                
                <h2 class="noo-sh-title-top">{{ $category->name }}</h2>
                <p>{{ $category->description }}</p>
                <!-- <a class="btn hvr-hover" href="#">Read More</a> -->
            </div>
        </div>
    </div>
</div>
<!-- End About Page -->

    
<!-- Start Shop Page  -->
<div class="shop-box-inner">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                <div class="right-product-box">
                    <div class="product-item-filter row">
                        <div class="col-12 col-sm-10 text-center text-sm-left">
                            <div class="toolbar-sorter-right">
                                <span>{{ trans('lang.category_page.sort_by') }}</span>
                                <select id="order_product" class="selectpicker show-tick form-control" data-placeholder="">
                                <option value="price_none">{{ trans('lang.category_page.price_none') }}</option>
                                <option value="price_asc">{{ trans('lang.category_page.price_asc') }}</option>
                                <option value="price_desc">{{ trans('lang.category_page.price_desc') }}</option>
                            </select>
                            </div>
                            <p id="item_count">{{ trans('lang.category_page.display_results', [ 'count' => count($products) ]) }}</p>
                        </div>
                        <div class="col-12 col-sm-2 text-center text-sm-right">
                            <ul class="nav nav-tabs ml-auto">
                                <li>
                                    <a class="nav-link <?php echo ($listView == '#list-view') ? 'active' : ''; ?>" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                </li>
                                <li>
                                    <a class="nav-link <?php echo ($listView == '#grid-view') ? 'active' : ''; ?>" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @include('frontend.product_display')

                </div>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                <div class="product-categori">
                    <div class="search-product">
                        <input class="form-control" placeholder="{{ trans('lang.category_page.search') }}" type="text" id="search-product-by-text">
                        <button type="submit" id="search_products"> <i class="fa fa-search"></i> </button>
                    </div>
                    <div class="filter-price-left">
                        <div class="title-left">
                            <h3>{{ trans('lang.category_page.price') }}</h3>
                        </div>
                        <div class="price-box-slider">
                            <div id="product-slider-range" class="slider-range"></div>
                            <p>
                                <input type="text" id="product-amount" readonly style="border:0; color:#fbb714; font-weight:bold;">
                                <button class="btn hvr-hover" type="submit">Filter</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<!-- End Shop Page -->
