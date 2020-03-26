<!-- Start Side Menu -->
<a href="#" class="close-side"><i class="fa fa-times"></i></a>
<li class="cart-box">
    <ul class="cart-list">
       
        <?php if(!empty($cart['items'])) {
            foreach($cart['items'] as $key => $row) { ?>
                <li>
                    <table>
                        <tr>
                            <td style="width: 60px;">
                                <a href="#" class="photo"><img src='{{ URL::to(asset("/storage/frontend/images/" . $row["image"] )) }}' class="cart-thumb" alt="" /></a>
                            </td>
                            <td>
                                <h6><a href="#">{{ $row['name'] }}</a></h6>
                                {{ $row['quantity'] }} kg x <span class="price">{{ $row['price'] }} lei/kg </span> = {{ $row['quantity'] * $row['price'] }} lei
                            </td>
                            <td style="text-align: center;width: 30px;">
                                <a href="#" class="remove_from_cart">
                                    <i class="fas fa-times"></i>
                                    {!! Form::hidden('row_id', $key, array('id' => 'row_id')) !!}
                                </a>
                            </td>
                        </tr>
                    </table>
                </li>
            <?php } ?>
            <li>
                <table>
                    <tr>
                        <td>{{ trans('lang.shop_page.cart_total') }}</td>
                        <td style="text-align: right">{{ price_with_currency($cart['subtotal']) }}</td>
                    </tr>
                </table>
            </li>
            <li>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12 text-center view-cart">
                        {{ Form::button(trans('lang.shop_page.view_cart'), array('class' => 'hvr-hover view-cart', 'type' => 'button', 'onclick' => 'location.href="/shop"' )) }}
                    </div>
                </div>                
            </li>
        <?php } ?>
    </ul>
</li>
<!-- End Side Menu -->