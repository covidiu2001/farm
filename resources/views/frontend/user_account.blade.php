<!-- Start My Account  -->
<div class="my-account-box-main">
    <div class="container">

        <div class="row float-right">
            {!!Form::open(array('url' => '/logout', 'class' => 'review-form-box', 'id' => 'formLogout')) !!}
                <div class="form-group col-md-11">
                    {{ Form::button(trans('lang.form_buttons.logout'), array('class' => 'hvr-hover', 'type' => 'submit')) }}
                </div>
            {!! Form::close() !!} 
        </div>
        <div class="clearfix"></div>

        <div class="my-account-page">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="{{ URL::to('showOrder') }}"> <i class="fa fa-gift"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>{{ trans('lang.user_account_page.your_order') }}</h4>
                                <p>{{ trans('lang.user_account_page.track_order') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="#"><i class="fa fa-lock"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Login &amp; security</h4>
                                <p>Edit login, name, and mobile number</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="#"> <i class="fa fa-location-arrow"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Your Addresses</h4>
                                <p>Edit addresses for orders and gifts</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="#"> <i class="fa fa-credit-card"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Payment options</h4>
                                <p>Edit or add payment methods</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="#"> <i class="fab fa-paypal"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>PayPal</h4>
                                <p>View benefits and payment settings</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="account-box">
                        <div class="service-box">
                            <div class="service-icon">
                                <a href="#"> <i class="fab fa-amazon"></i> </a>
                            </div>
                            <div class="service-desc">
                                <h4>Amazon Pay balance</h4>
                                <p>Add money to your balance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-box">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Gold &amp; Diamond Jewellery</h4>
                                    <ul>
                                        <li> <a href="#">Apps and more</a> </li>
                                        <li> <a href="#">Content and devices</a> </li>
                                        <li> <a href="#">Music settings</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Handloom &amp; Handicraft Store</h4>
                                    <ul>
                                        <li> <a href="#">Advertising preferences </a> </li>
                                        <li> <a href="#">Communication preferences</a> </li>
                                        <li> <a href="#">SMS alert preferences</a> </li>
                                        <li> <a href="#">Message center</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>The Designer Boutique</h4>
                                    <ul>
                                        <li> <a href="#">Amazon Pay</a> </li>
                                        <li> <a href="#">Bank accounts for refunds</a> </li>
                                        <li> <a href="#">Coupons</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Gift Boxes, Gift Tags, Greeting Cards</h4>
                                    <ul>
                                        <li> <a href="#">Leave delivery feedback</a> </li>
                                        <li> <a href="#">Lists</a> </li>
                                        <li> <a href="#">Photo ID proofs</a> </li>
                                        <li> <a href="#">Profile</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Other accounts</h4>
                                    <ul>
                                        <li> <a href="#">Amazon Business registration</a> </li>
                                        <li> <a href="#">Seller account</a> </li>
                                        <li> <a href="#">Amazon Web Services</a> </li>
                                        <li> <a href="#">Login with Amazon</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-desc">
                                    <h4>Shopping programs and rentals</h4>
                                    <ul>
                                        <li> <a href="#">Subscribe &amp; Save</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End My Account -->