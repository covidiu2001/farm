<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700');
            
            body{
                color: #666666;
                font-size: 15px;
                font-family: 'Dosis', sans-serif;
                line-height: 1.80857;
            }
            .wrapper {
                max-width: 1000px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f7f7f7;
            }
            h3 {
                font-size: 18px;
                font-weight: 700;
            }
            h4 {
                font-size: 16px;
                font-weight: 700;
            }
            .delivery_info {
                font-size: 18px;
                font-weight: 500;
            }

            table {
                width: 90%;
                margin: 0 auto;
            }
            .align_right{
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class='wrapper'>
            <div class='row'>
                <a class="navbar-brand" href="{{ URL::to('/')}}">
                    <img src="{{ URL::to(asset('/frontend/images/logo.png')) }}" class='admin-img-thumb'></img>
                </a>
            </div>
            <div class='row'>
                <h3>{{ trans('lang.order_email.hello') }} {{ $firstname }} {{ $name }}, </h3>
            </div>
            
            <div class='row'>
                <h4> {{ trans('lang.order_email.thanks_for_order') }} </h4>
                <hr>
                <h4> {{ trans('lang.order_email.title') }} </h4>
            </div>
            <hr>                
            <div class='row'>
                <table>
                    <thead>
                        <tr>
                            <td>{!! trans('lang.order_email.items') !!}</td>
                            <td class='align_right'>{!! trans('lang.order_email.quantity') !!}</td>
                            <td class='align_right'>{!! trans('lang.order_email.price') !!}</td>
                        </tr>
                    </thead>
                    <?php foreach($cart['items'] as $item) { 
                        echo '<tr>';
                            echo '<td>' . $item['name'] . '</td>';
                            echo '<td class="align_right">' . $item['quantity'] . '</td>';
                            echo '<td class="align_right">' . $item['price'] . '</td>';
                        echo '</tr>';
                    } ?>
                    <tr>
                        <td></td>
                        <td class='align_right'><?php echo trans('lang.order_email.subtotal'); ?></td>
                        <td class='align_right'><?php echo $cart['subtotal']; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class='align_right'><?php echo trans('lang.order_email.discount'); ?></td>
                        <td class='align_right'><?php echo $cart['discount']; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class='align_right'><?php echo trans('lang.order_email.coupon_discount'); ?></td>
                        <td class='align_right'><?php echo $cart['coupon_discount']; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class='align_right'><?php echo trans('lang.order_email.order_tax'); ?></td>
                        <td class='align_right'><?php echo $cart['order_tax']; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class='align_right'><?php echo trans('lang.order_email.order_shipping_cost'); ?></td>
                        <td class='align_right'><?php echo $cart['order_shipping_cost']; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class='align_right'><?php echo trans('lang.order_email.order_total'); ?></td>
                        <td class='align_right'><?php echo $cart['order_total']; ?></td>
                    </tr>
                </table>
                <hr>
                
                <table>
                    <tr>
                        <td><span class="delivery_info"> {!! trans('lang.order_email.delivery_info') . '<br>' !!} </span></td>
                    </tr>
                    <tr>
                        <td><?php echo $firstname . ' ' . $name; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $address_text; ?></td>
                    </tr>
                        <td><?php echo $address_text2; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $region_city_zipcode; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo $country; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo trans('lang.order_email.phone') . ': ' . $phone; ?></td>
                    </tr>
                </table>
                <hr>
                {{ trans('lang.order_email.order_received') }}
            </div>
        </div>
    </body>
</html>