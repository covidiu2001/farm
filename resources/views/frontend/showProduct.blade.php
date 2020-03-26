<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <?php if(!empty($product_images)) { ?>
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php 
                            $class = 'active';
                            foreach($product_images as $item) { ?>
                                <div class="carousel-item {{ $class }}"> 
                                    <img src='{{ URL::to(asset("/storage/frontend/images/" . $item->image)) }}' class="d-block w-100">
                                </div>                               
                            <?php 
                                $class = '';
                            }
                            ?>

                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span class="sr-only">Previous</span> 
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
                            <i class="fa fa-angle-right" aria-hidden="true"></i> 
                            <span class="sr-only">Next</span> 
                        </a>
                        <ol class="carousel-indicators">
                            <?php 
                            $class = 'active';
                            $i = 0;
                            foreach($product_images as $item) { ?>                            
                                <li data-target="#carousel-example-1" data-slide-to="{{ $i }}" class="{{ $class }}">
                                    <img src='{{ URL::to(asset("/storage/frontend/images/" . $item->image)) }}' class="d-block w-100 img-fluid" alt=""/>
                                </li>
                            <?php 
                                $class = '';
                                $i++;
                            } ?>
                        </ol>
                    </div>                    
                <?php } ?>
            </div>
            
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>{{ $product->name }}</h2>
                    <h5> 
                        <!--<del>$ 60.00</del>--> 
                        {{ price_with_currency($product->price) }}
                    </h5>
                    <?php 
                        $stoc = $product_stoc->intrari - $product_stoc->iesiri;
                    ?>
                    <p class="available-stock">
                        <span> {{ $stoc }} {{ trans('lang.product_page.available_products') }}
                            @if ($product_stoc->iesiri > 0)
                                &nbsp;/&nbsp;<a href="#">{{ $product_stoc->iesiri }} {{ trans('lang.product_page.available_products') }} </a>
                            @endif
                        </span><p>
                    <h4>{{ trans('lang.product_page.description') }}</h4>
                    <p>{{ $product->description }}</p>
                    <p>{!! nl2br($product->long_description) !!}</p>
                    <?php if($stoc > 0 ) { ?>
                        <ul>
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">{{ trans('lang.product_page.quantity') }}</label>
                                    <input class="form-control" value="1" min="1" max="{{ $stoc }}" type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <!--<a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a>-->
                                <a class="btn hvr-hover" data-fancybox-close="" href="#">{{ trans('lang.product_page.add_to_cart') }}</a>
                            </div>
                        </div>                        
                    <?php } else { ?>
                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                            </div>
                        </div>                     
                    <?php } ?>


<!--                <div class="add-to-btn">
                        <div class="add-comp">
                            <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                            <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                        </div>
                        <div class="share-bar">
                            <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                            <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>

        <?php if(!empty($product_reviews)) { ?>
            <div class="row my-5">
                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        <h2>Product Reviews</h2>
                    </div>
                    
                    <div class="card-body">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <div class="media mb-3">
<!--                                <div class="mr-2"> 
                                    <img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                                </div>-->
                                <div class="media-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                                    <small class="text-muted">Posted by Anonymous on 3/1/18</small>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                        <a href="#" class="btn hvr-hover">Leave a Review</a>
                    </div>
                </div>
            </div> 
        <?php } ?>
        <div class="clearfix"></div>

        <?php if(!empty($product_related_items)) {?>
            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>{{ trans('lang.product_page.related_products') }}</h1>
                        <!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>-->
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        <?php foreach($product_related_items as $product) { ?>
                            <?php $related_image = $related_product_images['product_id_' . $product->id]->image; ?>
                            <div class="item">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <img src="{{ URL::to(asset("/storage/frontend/images/" . $related_image)) }}" class="img-fluid" alt="Image">
                                        <div class="mask-icon">
                                            <ul>
                                                <li><a href="{{ URL::to('showProduct/' . $product->id) }}" data-toggle="tooltip" data-placement="right" title="{{ trans('lang.front_page.view') }}"><i class="fas fa-eye"></i></a></li>
                                                <!--<li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>-->
                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="{{ trans('lang.front_page.add_to_wishlist') }}"><i class="far fa-heart"></i></a></li> 
                                            </ul>
                                            <!--
                                            <a class="cart add_to_cart" href="#">{{ trans('lang.front_page.add_to_cart') }}</a>
                                            {!! Form::hidden('product_id', $product->id, array('id' => 'product_id')) !!}
                                            {!! Form::hidden('quantity', 1, array('id' => 'quantity')) !!}
                                            -->
                                            
                                        </div>
                                    </div>
                                    <div class="why-text">
                                        <h4>{{ $product->name }}</h4>
                                        <h5>{{ price_with_currency($product->price) . ' / kg' }}</h5>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>        
        <?php } ?>
    </div>
</div>
<!-- End Cart -->

<!-- Start Instagram Feed  -->
<?php if(!empty($instagram_feed)) { ?>
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-01.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-02.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-03.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-04.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-06.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-07.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-08.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-09.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="images/instagram-img-05.jpg" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Instagram Feed  -->