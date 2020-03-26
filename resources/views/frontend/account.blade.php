<div class="cart-box-main">
    <div class="container">
        <div class="row title-left">
            <h3>{{ trans('lang.account_page.account_title_text') }}</h3>
        </div>

        <div class="row new-account-login">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="form-row">
                    {!!Form::open(array('url' => '/login', 'class' => 'review-form-box', 'id' => 'formRegister')) !!}
                        <div class="row">
                            <div id="msgSubmit" class="hidden">{{ trans('lang.required_form_fields') }}</div>
                            <div class="col-md-12 mb-3">
                                <h2>{!! trans('lang.account_page.title') !!}</h2>
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
                            
                            @if ($errors->any())
                                <div class="form-group col-md-11">
                                    <div class="alert alert-danger">
                                        {{ implode('', $errors->all(':message')) }}
                                    </div>
                                </div>
                            @endif
                            
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
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h2>{!! trans('lang.account_page.new_client_title') !!}</h2>
                        <p>{!! trans('lang.account_page.new_client_text') !!}</p>
                    </div>
                    <div class="form-group col-md-11">
                        <div class="review-form-box">
                            <a class="btn hvr-hover a-button" href="{{ URL::to('/addUser') }} ">{{ trans('lang.form_buttons.register') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>