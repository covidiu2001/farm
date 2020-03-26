<!-- Start Products  -->
@if(!empty($categories))

<div class="products-box">
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                    <h1>{{ trans('lang.front_page.our_products_header') }}</h1>
                    <p>{{ trans('lang.front_page.our_products_text') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="special-menu text-center">
                    <div class="button-group filter-button-group">
                        <button class="active" data-filter="*">{{ trans('lang.front_page.all_products') }}</button>
                        
                        @foreach($categories as $category)
                            <?php $dataFilter = '.' . str_replace(' ', '-', mb_strtolower($category->name)); ?>
                            <button data-filter="{{ $dataFilter }}">{{ trans('lang.front_page.products' . $dataFilter) }}</button>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>

        
        @if(!empty($products))
            <div class="row special-list">
                @foreach($products as $product)
                    <?php $dataFilter = str_replace(' ', '-', mb_strtolower($product->category_name)); ?>
                    <?php 
                        $datetime1 = new DateTime('now');
                        $datetime2 = new DateTime($product->created_at);
                        $interval = $datetime1->diff($datetime2);
                    ?>
                    <div class="col-lg-3 col-md-6 special-grid {{ $dataFilter }}" >
                        <div class="products-single fix">
                            <div class="box-img-hover">
                                <?php if( $product->intrari - $product->iesiri <= 0 ) { ?>
                                    <div class="type-lb">
                                        <p class="sold-out">Indisponibil</p>
                                    </div>
                                <?php } else { ?>
                                    <?php if( $interval->days < Config::get('constants.DAYS_INTERVAL_FOR_NEW_PRODUCT') ) { ?>
                                        <div class="type-lb">
                                            <p class="new">New</p>
                                        </div>
                                    <?php } else { ?>
                                        <div class="type-lb">
                                            <p class="sale">Sale</p>
                                        </div>                                
                                    <?php } ?>
                                <?php } ?>

                                <img src="{{ URL::to(asset("/storage/frontend/images/" . $product->image)) }}" class="img-fluid" alt="Image">
                                <div class="mask-icon">
                                    {!! Form::hidden('product_id', $product->id, array('id' => 'product_id')) !!}
                                    {!! Form::hidden('quantity', 1, array('id' => 'quantity')) !!}
                                    <ul>
                                        <li><a href="{{ URL::to('showProduct/' . $product->id) }}" data-toggle="tooltip" data-placement="right" title="{{ trans('lang.front_page.view') }}"><i class="fas fa-eye"></i></a></li>
                                        <!--<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>-->
                                        <li><a href="#" data-toggle="tooltip" data-placement="right" title="{{ trans('lang.front_page.add_to_wishlist') }}"><i class="far fa-heart"></i></a></li>
                                    </ul>
                                    <?php if( $product->intrari - $product->iesiri > 0 ) { ?>
                                        <a class="cart add_to_cart" href="#">{{ trans('lang.front_page.add_to_cart') }}</a>
                                    <?php } ?>                                    
                                    
                                </div>
                            </div>
                            <div class="why-text">
                                <h4>{{ $product->name }}</h4>
                                <?php if( $product->intrari - $product->iesiri > 0 ) { ?>
                                    <h5>{{ $product->price . ' lei / kg' }}</h5>
                                <?php } ?>                             
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        @endif

    </div>
</div>
<!-- End Products  -->
@endif