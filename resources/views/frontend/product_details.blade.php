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
        </ul>
        
        <?php echo $listView; ?>
        <?php if($listView == '#grid-view' && $available_quantity > 0) { ?>
            <a class="cart" href="#">{{ trans('lang.front_page.add_to_cart') }}</a>
        <?php } ?>
    </div>
</div>
