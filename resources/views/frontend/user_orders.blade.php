<div class="wishlist-box-main">
    <div class="container">
        <div class="row">
            <div class="col-12">
                {!!Form::open(array('url' => '/account', 'class' => 'review-form-box', 'id' => 'account')) !!}
                    <div class="form-group float-right">
                        {{ Form::hidden('_method', 'get') }}
                        {{ Form::button(trans('lang.menu.account'), array('class' => 'hvr-hover', 'type' => 'submit')) }}
                    </div>
                {!! Form::close() !!} 
            </div>            
        </div>
        <div class="row">
            <div class="col-lg-12">
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
                            <?php //for($i = 1; $i < 10; $i ++) { ?>
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
                            <?php //} ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>