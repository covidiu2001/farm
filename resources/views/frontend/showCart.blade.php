<!-- Start Cart  -->
<?php if( !empty($cart) && !empty($cart['items']) ) { ?>
    <div class="cart-box-main">
        <div class="container">
            @include('includes.messages')
            
            <?php if(!Auth::check()) { ?>
                <div class="row new-account-login">
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="title-left">
                            <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">{!! trans('lang.account_page.title') !!}</a></h5>                        
                        </div>
                        <div class="">
                            {!!Form::open(array('url' => '/login', 'class' => 'collapse review-form-box', 'id' => 'formLogin')) !!}
                                <div class="row">
                                    <div id="msgSubmit" class="hidden">{{ trans('lang.required_form_fields') }}</div>
                                    <div class="col-md-12 mb-3">
                                        <p>{!! trans('lang.account_page.text1') !!}</p>
                                    </div>
                                    <div class="form-group col-md-11">
                                        {{ Form::label('email', trans('lang.account_page.email_label')) }}<span class="mandatory">*</span>
                                        {{ Form::text('email', '', 
                                            [
                                                'class' => 'form-control',
                                                'id' => 'email', 
                                                'placeholder' => trans('lang.account_page.email_placeholder'), 
                                                'required' => 'required', 
                                                'data-error' => trans('lang.required'),
                                            ]
                                        ) }}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-md-11">
                                        {{ Form::label('password', trans('lang.account_page.password_label')) }}<span class="mandatory">*</span>
                                        {{ Form::password('password', 
                                            [
                                                'class' => 'form-control',
                                                'id' => 'password',
                                                'placeholder' => trans('lang.account_page.password_placeholder'),
                                                'required' => 'required',
                                                'data-error' => trans('lang.required'),
                                            ]
                                        ) }}
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-11">
                                        {{ Form::button(trans('lang.form_buttons.login'), array('class' => 'hvr-hover', 'type' => 'submit')) }}
                                    </div>
                                    <div class="form-group col-md-11">
                                        <span class="mandatory">* {{ trans('lang.mandatory_fields') }}</span>
                                    </div>
                                </div>
                            {!! Form::close() !!} 
                        </div>                        
                        
                    </div>
                    <div class="col-sm-6 col-lg-6 mb-3">
                        <div class="title-left">
                            <h3><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h3>
                        </div>
                        <form class="mt-3 collapse review-form-box" id="formRegister">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="InputName" class="mb-0">First Name</label>
                                    <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                                <div class="form-group col-md-6">
                                    <label for="InputLastname" class="mb-0">Last Name</label>
                                    <input type="text" class="form-control" id="InputLastname" placeholder="Last Name"> </div>
                                <div class="form-group col-md-6">
                                    <label for="InputEmail1" class="mb-0">Email Address</label>
                                    <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                                <div class="form-group col-md-6">
                                    <label for="InputPassword1" class="mb-0">Password</label>
                                    <input type="password" class="form-control" id="InputPassword1" placeholder="Password"> </div>
                            </div>
                            <button type="submit" class="btn hvr-hover">Register</button>
                        </form>
                    </div>
                </div>
            <?php } ?>
            
            
            <div class="row">
                
                <div class="col-lg-12">
                    <h1>{{ trans('lang.shop_page.cart_title') }}</h1>
                    <div class="table-main table-responsive">
                        {!! Form::open(array('url' => '/updateCart', 'class' => 'review-form-box', 'id' => 'updateCartForm')) !!}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('lang.shop_page.images_title') }}</th>
                                    <th>{{ trans('lang.shop_page.product_title') }}</th>
                                    <th>{{ trans('lang.shop_page.price_title') }}</th>
                                    <th>{{ trans('lang.shop_page.quantity') }}</th>
                                    <th>{{ trans('lang.shop_page.cart_total') }}</th>
                                    <th>{{ trans('lang.shop_page.remove') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $subtotal = 0;
                                    foreach($cart['items'] as $key => $val) { ?>
                                    <tr>
                                        <td class="thumbnail-img">
                                            <a href="{{ URL::to('/showProduct/' . $key) }}">
                                                <img class="img-fluid" src="{{ URL::to(asset('/storage/frontend/images/' . $val['image'])) }}" alt="" />
                                            </a>
                                        </td>
                                        <td class="name-pr">
                                            <a href="{{ URL::to('/showProduct/' . $key) }}">
                                                {{ $val['name'] }}
                                            </a>
                                        </td>
                                        <td class="price-pr">
                                            <p>{{ price_with_currency($val['price']) }}</p>
                                        </td>
                                        <td class="quantity-box">
                                            <!--<input type="number" value="{{ $val['quantity'] }}" min="0" step="1" class="c-input-text qty text">-->
                                            {{ Form::input('number', 'quantity[' . $key . ']', $val['quantity'], ['class' => 'c-input-text qty text', 'min' => '0', 'step' => '1']) }}
                                        </td>
                                        <td class="total-pr">
                                            <p>{{ price_with_currency($val['price'] * $val['quantity']) }} lei</p>
                                        </td>
                                        <td class="remove-pr">
                                            <a href="#">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                        {!! Form::hidden('product_id['. $key . ']', $key) !!}
                                        {!! Form::hidden('price', $val['price'], array('class' => 'price')) !!}
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                        
                        {{ Form::button(trans('lang.shop_page.update_cart'), array('class' => 'hvr-hover pull-right mb-20 float-right', 'type' => 'submit')) }}
                        {!! Form::close() !!} 
                        
                        <div class="clearfix"></div>
                        
                        <div class="col-lg-6 col-sm-12 pr-0 pl-0 float-right">
                            <div class="coupon-box">
                                <div class="input-group input-group-sm">
                                    <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                                    <div class="input-group-append">
                                        <button class="btn btn-theme hvr-hover" type="button">{{ trans('lang.shop_page.apply_coupon') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-sm-6 col-lg-6 mb-3"></div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="order-box">
                        <div class="title-left">
                            <h3>{{ trans('lang.shop_page.order_summary') }}</h3>
                        </div>
                        
                        <div class="d-flex">
                            <h4>{{ trans('lang.shop_page.order_subtotal') }}</h4>
                            <div class="ml-auto font-weight-bold">{{ price_with_currency($cart['subtotal']) }}</div>
                        </div>
                        <hr class="my-1">
                        
                        <?php if(!empty($cart['discount'])) { ?>
                            <div class="d-flex">
                                <h4>{{ trans('lang.shop_page.order_discount') }}</h4>
                                <div class="ml-auto font-weight-bold">{{ price_with_currency($cart['discount']) }}</div>
                            </div>
                        <?php } ?>
                        
                        <?php if(!empty($cart['coupon_discount'])) { ?>
                            <div class="d-flex">
                                <h4>{{ trans('lang.shop_page.order_coupon_discount') }}</h4>
                                <div class="ml-auto font-weight-bold">{{ price_with_currency($cart['coupon_discount']) }}</div>
                            </div>
                        <?php } ?>
                        <hr class="my-1">
                        
                        <?php if(!empty($cart['order_tax'])) { ?>
                            <div class="d-flex">
                                <h4>{{ trans('lang.shop_page.order_tax') }}</h4>
                                <div class="ml-auto font-weight-bold">{{ price_with_currency($cart['order_tax']) }}</div>
                            </div>
                        <?php } ?>

                        <?php if(!empty($cart['order_shipping_cost'])) { ?>
                            <div class="d-flex">
                                <h4>{{ trans('lang.shop_page.order_shipping_cost') }}</h4>
                                <div class="ml-auto font-weight-bold">{{ price_with_currency($cart['order_shipping_cost']) }}</div>
                            </div>
                        <?php } ?>

                        <hr>
                        <?php if(!empty($cart['order_total'])) { ?>
                            <div class="d-flex">
                                <h4>{{ trans('lang.shop_page.order_total') }}</h4>
                                <div class="ml-auto h5">{{ price_with_currency($cart['order_total']) }}</div>
                            </div>
                        <?php } ?>

                        <hr> 
                    </div>
                
                    <?php 
                        $class = 'disabled';
                        if(Auth::check()) { 
                            $class = '';
                        }    
                    ?>
                    <div class="d-flex shopping-box">
                        <a href="{{ URL::to('/checkoutCart') }}" class="ml-auto btn hvr-hover {{ $class }}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>

<div class="contact-box-main">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <h2>{{ trans('lang.shop_page.no_items_in_cart') }}</h2>
            </div>
        </div>
    </div>
</div>
    
    
<?php } ?>
    <!-- End Cart -->