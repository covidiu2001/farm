<label for="state">{{ trans('lang.user_account.region') }}<span class="mandatory">*</span></label>
<?php 
    if(!empty($regions)) {
        $defaultRegion = !empty($user_details->region) ? $user_details->region : '';
        echo Form::select('region', $regions->pluck('name','id'), $defaultRegion, ['class' => 'wide w-100', 'id' => 'regions']);
    }
?>
<div class="invalid-feedback"> Please provide a valid region. </div>