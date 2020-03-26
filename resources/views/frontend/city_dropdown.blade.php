<label for="zip">{{ trans('lang.user_account.city') }}<span class="mandatory">*</span></label>
<?php
    $defaultCity = !empty($user_details->city) ? $user_details->city : '';
    echo Form::select('city', $cities->pluck('name','id'), $defaultCity, ['class' => 'wide w-100', 'id' => 'city']);
?>
<div class="invalid-feedback"> City required. </div>