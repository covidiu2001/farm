<div class="cart-box-main">
    <div class="container">
        <div class="row title-left">
            <h3>{{ trans('lang.form_buttons.register') }}</h3>
        </div>

        <div class="row new-account-login">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="form-row">
                    {!!Form::open(array('url' => '/register', 'class' => 'review-form-box', 'id' => 'formRegisterUser')) !!}
                        <div class="row">
                            <div id="msgSubmit" class="hidden">{{ trans('lang.required_form_fields') }}</div>
                            <div class="form-group col-md-11">
                                {{ Form::label('email', trans('lang.register_page.email_label')) }}<span class="mandatory">*</span>
                                {{ Form::text('email', '', 
                                    [
                                        'class' => 'form-control',
                                        'id' => 'email', 
                                        'placeholder' => trans('lang.register_page.email_placeholder'), 
                                        'required' => 'required', 
                                        'data-error' => trans('lang.required'),
                                    ]
                                ) }}
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-md-11">
                                {{ Form::label('password', trans('lang.register_page.password_label')) }}<span class="mandatory">*</span>
                                {{ Form::password('password', 
                                    [
                                        'class' => 'form-control',
                                        'id' => 'password',
                                        'placeholder' => trans('lang.register_page.password_placeholder'),
                                        'required' => 'required',
                                        'data-error' => trans('lang.required'),
                                    ]
                                ) }}
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-md-11">
                                {{ Form::label('confirm_password', trans('lang.register_page.confirm_password_label')) }}<span class="mandatory">*</span>
                                {{ Form::password('confirm_password', 
                                    [
                                        'class' => 'form-control',
                                        'id' => 'confirm_password',
                                        'placeholder' => trans('lang.register_page.password_placeholder'),
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
        </div>
    </div>
</div>

<?php return; ?>

                     <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h5>
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