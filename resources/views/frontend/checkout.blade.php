<div class="cart-box-main">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="checkout-address">
                    <div class="title-left">
                        <h3>{{ trans('lang.shop_page.billing_address') }}</h3>
                    </div>
                        {!!Form::open(['action' => ['CartController@completeOrder'], 'method' => 'POST', 'class' => 'needs-validation', 'id' => 'orderForm']) !!}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                {{ Form::label('firstname', trans('lang.user_account.first_name')) }}
                                {{ Form::text('firstname', Auth::user()->firstname, [ 'class' => 'form-control', 'id' => 'firstname', 'readonly' => 'readonly' ]) }}
                            </div>
                            <div class="col-md-6 mb-3">
                                {{ Form::label('name', trans('lang.user_account.name')) }}
                                {{ Form::text('name', Auth::user()->name, [ 'class' => 'form-control', 'id' => 'name', 'readonly' => 'readonly' ]) }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                {{ Form::label('email', trans('lang.user_account.email')) }}
                                {{ Form::text('zip', Auth::user()->email, [ 'class' => 'form-control', 'id' => 'email', 'readonly' => 'readonly' ]) }}
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <?php 
                                    $otherArr1 = array('class' => 'form-control');
                                    if( empty( $user_details->phone ) ) {
                                        $span = '<span class="mandatory">*</span>';
                                        $otherArr1['placeholder'] = trans('lang.user_account.phone');
                                        $otherArr1['required'] = 'required';
                                        $otherArr1['data-error'] = trans('lang.required');
                                        $phone = '';
                                        $errorDiv = '<div class="help-block with-errors"></div>';
                                    } else {
                                        $span = '';
                                        $otherArr1['readonly'] = 'readonly';
                                        $phone = $user_details->phone;
                                        $errorDiv = '';
                                    }
                                    echo Form::label('phone', trans('lang.user_account.phone')) . $span;
                                    echo Form::text('phone', $phone, $otherArr1);
                                    echo $errorDiv;
                                ?>                                
                            </div>
                        </div>                        
 
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="country">{{ trans('lang.user_account.country') }}<span class="mandatory">*</span></label>
                                <?php if (!empty($countries)) { ?>
                                    {!! Form::select('country', $countries->pluck('name', 'id'), Config::get('constants.DEFAULT_COUNTRY_ID'), ['class' => 'wide w-100', 'id' => 'country']) !!}
                                <?php } ?>
                            </div>
                            <div class="col-md-6 mb-3" id="region_dropdown">
                                @include('frontend.region_dropdown')
                            </div>
                            <div class="col-md-6 mb-3" id="city_dropdown">
                                @include('frontend.city_dropdown')
                            </div>
                            <div class="col-md-6 mb-3 form-group">
                                <?php 
                                    echo Form::label('zipcode', trans('lang.user_account.zipcode')) . '<span class="mandatory">*</span>';
                                    $zipcode = !empty($user_details->zipcode) ? $user_details->zipcode : '';
                                    echo Form::text('zipcode', $zipcode, [ 'class' => 'form-control', 'placeholder' => trans('lang.user_account.zipcode'), 'id' => 'zipcode', 'required' => 'required', 'data-error' => trans('lang.required') ]);
                                ?>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        
                        <div class="mb-3 form-group">
                            <?php 
                                echo Form::label('address_text', trans('lang.user_account.address')) . '<span class="mandatory">*</span>';
                                $address = !empty($user_details->address_street) ? $user_details->address_street : '';
                                echo Form::text('address_text', $address, [ 'class' => 'form-control', 'id' => 'address_text', 'placeholder' => 'Address', 'required' => 'required', 'data-error' => trans('lang.required') ]);
                            ?>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="mb-3">
                            <?php 
                                echo Form::label('address_text2', trans('lang.user_account.address2'));
                                $address2 = !empty($user_details->address_street2) ? $user_details->address_street2 : '';
                                echo Form::text('address_text2', $address2, [ 'class' => 'form-control', 'id' => 'address_text2', 'placeholder' => 'Second address' ]);
                            ?>
                        </div>
                        <div class="mb-3">
                            <span class="mandatory">* {{ trans('lang.mandatory_fields') }}</span>
                        </div>
                        {{ Form::button(trans('lang.shop_page.order'), array('class' => 'btn btn-theme hvr-hover', 'type' => 'submit')) }}
                        {!! Form::close() !!}
                    <div id="msgSubmit" class="hidden">{{ trans('lang.required_form_fields') }}</div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="col-md-12 col-lg-12">
                    <div class="odr-box">
                        <div class="title-left">
                            <h3>Shopping cart</h3>
                        </div>
                        
                        <div class="rounded p-2 bg-light">
                            <?php foreach ($cart['items'] as $key => $val) { ?>
                                <div class="media mb-2 border-bottom">
                                    <div class="media-body">
                                        <a href="{{ URL::to('/showProduct/' . $key) }}"> {{ $val['name'] }} </a>
                                        <div class="small text-muted">
                                            {{ trans('lang.shop_page.price_title') }} {{ price_with_currency($val['price']) }} 
                                            <span class="mx-2">|</span> 
                                            {{ trans('lang.shop_page.quantity') }} {{ $val['quantity'] }}
                                            <span class="mx-2">|</span>
                                            {{ trans('lang.shop_page.order_subtotal') }}: {{ price_with_currency($val['price'] * $val['quantity']) }}
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="rounded p-2 bg-light">
                            <div class="d-flex">
                                <h4>{{ trans('lang.shop_page.order_total') }}</h4>
                                <div class="ml-auto h5">{{ price_with_currency($cart['order_total']) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>