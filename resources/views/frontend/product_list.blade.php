<div class="list-view-box">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
            <div class="products-single fix">
                <div class="box-img-hover">
                    <div class="type-lb">
                        <?php if ($available_quantity > 0) { ?>
                            <p class="sale">{{ trans('lang.product_page.available') }}</p>
                        <?php } else { ?>
                            <p class="sold-out">{{ trans('lang.product_page.notavailable') }}</p>
                        <?php } ?>
                    </div>
                    <?php if (isset($product_image['product_id_' . $product->id]->image)) {
                            $image = $product_image['product_id_' . $product->id]->image; ?>
                        <img src="{{ URL::to(asset('/storage/frontend/images/' . $image)) }}" class="img-fluid" alt="Image">
                    <?php } ?>
                    <div class="mask-icon">
                        <ul>
                            <li><a href="{{ URL::to('showProduct/' . $product->id) }}" data-toggle="tooltip" data-placement="right" title="{{ trans('lang.front_page.view') }}"><i class="fas fa-eye"></i></a></li>
                            <!--<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>-->
                            <?php if ($available_quantity == 0) { ?>
                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="{{ trans('lang.front_page.add_to_wishlist') }}"><i class="far fa-heart"></i></a></li>
                            <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
            <div class="why-text full-width">
                <h4>{{ $product->name }}</h4>
                <!--<h5> <del>$ 60.00</del> $40.79</h5>-->                
                <?php if ($available_quantity > 0) { ?>
                    <h5>{{ price_with_currency($product->price) . ' / kg' }}</h5>
                <?php } ?>
                <p>{{ $product->description }}</p>
                <?php if ($available_quantity > 0) { ?>
                    <p>
                        {{ trans('lang.shop_page.quantity') }}
                        {{ Form::input('number', 'quantity', 1, ['class' => 'form-control-front', 'id' => 'quantity', 'placeholder' => trans('lang.shop_page.quantity'), 'min' => '0', 'step' => '1']) }}
                    </p>

                    <a class="btn hvr-hover add_to_cart" href="#">{{ trans('lang.front_page.add_to_cart') }}</a>
                    {!! Form::hidden('product_id', $product->id, array('id' => 'product_id')) !!}
                <?php } ?>
            </div>
        </div>
    </div>
</div>  