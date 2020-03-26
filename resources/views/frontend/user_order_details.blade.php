<div class="order-details my-account-box-main">
    <div class="container">
        <div class="row col-9 mx-auto">
            <div class="col-6">
                <h4> {{ trans('lang.order_email.title') }} </h4>
            </div>
            <div class="col-6">
                {!!Form::open(array('url' => '/showOrder', 'class' => 'review-form-box', 'id' => 'showOrder')) !!}
                    <div class="form-group float-right">
                        {{ Form::hidden('_method', 'get') }}
                        {{ Form::button(trans('lang.user_account_page.your_order'), array('class' => 'hvr-hover', 'type' => 'submit')) }}
                    </div>
                {!! Form::close() !!} 
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row col-9 mx-auto">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>{!! trans('lang.order_email.items') !!}</th>
                        <th>{!! trans('lang.order_email.image') !!}</th>
                        <th>{!! trans('lang.order_email.quantity') !!}</th>
                        <th>{!! trans('lang.order_email.price') !!}</th>
                        <th>{!! trans('lang.order_email.total') !!}</th>
                    </tr>
                </thead>
                    <tbody>
                    <?php $subtotal = 0; ?>
                    <?php foreach($order_details as $item) { ?>
                        <tr>
                            <td><?php echo $item['product_name']; ?></td>
                            <td><img src="{{ URL::to(asset('/storage/frontend/images/' . $item['image'])) }}"></td>
                            <td class="text-right"><?php echo $item['quantity']; ?></td>
                            <td class="text-right"><?php echo price_with_currency($item['unit_price']); ?></td>
                            <td class="text-right"><?php echo price_with_currency($item['quantity'] * $item['unit_price']); ?></td>
                        </tr>
                        <?php $subtotal += ($item['quantity'] * $item['unit_price']); ?>
                    <?php } ?>
                        <tr>
                            <td class="text-right" colspan="4">{!! trans('lang.order_email.subtotal') !!}</td>
                            <td class="text-right"><?php echo price_with_currency($subtotal); ?></td>
                        </tr>                    
                        <tr>
                            <td class="text-right" colspan="4">{!! trans('lang.order_email.discount') !!}</td>
                            <td class="text-right"><?php echo price_with_currency($order['discount']); ?></td>
                        </tr>                    
                        <tr>
                            <td class="text-right" colspan="4">{!! trans('lang.order_email.coupon_discount') !!}</td>
                            <td class="text-right"><?php echo price_with_currency($order['coupon_discount']); ?></td>
                        </tr>                    
                        <tr>
                            <td class="text-right" colspan="4">{!! trans('lang.order_email.order_tax') !!}</td>
                            <td class="text-right"><?php echo price_with_currency($order['order_tax']); ?></td>
                        </tr>                    
                        <tr>
                            <td class="text-right" colspan="4">{!! trans('lang.order_email.order_shipping_cost') !!}</td>
                            <td class="text-right"><?php echo price_with_currency($order['order_shipping_cost']); ?></td>
                        </tr>                    
                        <tr>
                            <td class="text-right" colspan="4">{!! trans('lang.order_email.order_total') !!}</td>
                            <td class="text-right"><?php echo price_with_currency($order['total']); ?></td>
                        </tr>
                </tbody>
            </table>            
        </div>
        <div class="row col-9 mx-auto">
            
        </div>
             
    </div>
</div>
<?php return; ?>
                
                
                <div class="table-main table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('lang.user_order_page.order') }}</th>
                                <th>{{ trans('lang.user_order_page.order_data') }}</th>
                                <th>{{ trans('lang.user_order_page.order_total') }}</th>
                                <th>{{ trans('lang.user_order_page.order_status') }}</th>
                                <th>{{ trans('lang.user_order_page.order_action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 1; $i < 10; $i ++) { ?>
                                <?php foreach($orders as $order) { ?>
                                    <tr>
                                        <td class="quantity-box text-right">
                                            <?php echo Config::get('constants.ORDER_PREFIX') . $order['id']; ?>
                                        </td>
                                        <td class="quantity-box text-center">
                                            <?php echo date("d.m.Y", strtotime($order['order_date'])); ?>
                                        </td>
                                        <td class="price-pr text-right">
                                            <p><?php price_with_currency($order['total']); ?></p>
                                        </td>
                                        <td class="quantity-box">
                                            <?php echo trans('lang.order_status.' . $order['status']); ?>
                                        </td>
                                        <td>
                                            {!!Form::open(array('url' => '/user_order_details', 'class' => 'review-form-box', 'id' => 'user_order_details')) !!}
                                            {!! Form::hidden('order_id', $order['id'], array()) !!}
                                            {!! Form::button(trans('lang.user_order_page.view_order'), array('class' => 'hvr-hover', 'type' => 'submit')) !!}
                                            {!! Form::close() !!}                                             
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>