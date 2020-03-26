<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">        

        <!-- Site Metas -->
        <title><?php echo 'Admin zone - ' . Config::get('constants.SITE_TITLE'); ?></title>

        <!-- Bootstrap -->
        {{ Html::style('backend/css/bootstrap.min.css') }}
        <!-- styles -->
        {{ Html::style('backend/css/styles.css') }}
   
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        @yield('content')
    </body>
    
    <!-- ALL JS FILES -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('backend/js/jquery.js') }}
    {{ HTML::script('backend/js/bootstrap.min.js') }}
    
    {{ HTML::script('frontend/js/ajaxLoading.js') }}
    {{ HTML::script('backend/js/custom.js') }}
    
    <div class="modal"><!-- Place at bottom of page --></div>
</html>
