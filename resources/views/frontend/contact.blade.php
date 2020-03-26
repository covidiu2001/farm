    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        <h2>{{ trans('lang.contact_page.contact_us') }}</h2>
                        <p>{!! trans('lang.contact_page.contact_us_text') !!}</p>
                            {!! Form::open(array('url' => '/sendMessage', 'id' => 'contactForm')) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                       {!! Form::text('name', '', ['class' => 'form-control', 'id' => 'name', 'placeholder' => trans('lang.contact_page.name_placeholder'), 'required' => 'required', 'data-error' => trans('lang.contact_page.name_field_error')]) !!}
                                       <div class="help-block with-errors"></div>
                                   </div>                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       {!! Form::text('email', '', ['class' => 'form-control', 'id' => 'email', 'placeholder' => trans('lang.contact_page.email_placeholder'), 'required' => 'required', 'data-error' => trans('lang.contact_page.email_field_error')]) !!}
                                       <div class="help-block with-errors"></div>
                                   </div>                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       {!! Form::text('subject', '', ['class' => 'form-control', 'id' => 'msg_subject', 'placeholder' => trans('lang.contact_page.subject_placeholder'), 'required' => 'required', 'data-error' => trans('lang.contact_page.subject_field_error')]) !!}
                                       <div class="help-block with-errors"></div>
                                   </div>                                   
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                       {!! Form::textarea('message', '', ['class' => 'form-control', 'id' => 'message', 'rows' => '4', 'placeholder' => trans('lang.contact_page.message_placeholder'), 'required' => 'required', 'data-error' => trans('lang.contact_page.message_field_error')]) !!}
                                       <div class="help-block with-errors"></div>
                                   </div>
                                    <div class="submit-button text-center">
                                        
                                        {{ Form::button(trans('lang.form_buttons.submit'), array('class' => 'hvr-hover', 'type' => 'submit')) }}
                                        <!--<button class="btn hvr-hover" id="submit" type="submit">Send Message</button>-->
                                        <div id="msgSubmit" class="hidden">{{ trans('lang.required_form_fields') }}</div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>    
                        {!! Form::close() !!}
                    </div>
                </div>
				<div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>{!! trans('lang.contact_page.contact_info') !!}</h2>
                        <p>{!! trans('lang.contact_page.contact_info_text') !!}</p>
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: Michael I. Days 9000 <br>Preston Street Wichita,<br> KS 87213 </p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:+1-888705770">+1-888 705 770</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:contactinfo@gmail.com">contactinfo@gmail.com</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
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
    <!-- End Instagram Feed  -->
