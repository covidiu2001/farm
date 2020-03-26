<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">        

        <!-- Site Metas -->
        <title><?php echo Config::get('constants.SITE_TITLE'); ?></title>
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Site Icons -->
        <link rel="shortcut icon" href="/frontend/images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="/frontend/images/apple-touch-icon.png">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="/frontend/css/bootstrap.min.css">
        <!-- Site CSS -->
        <link rel="stylesheet" href="/frontend/css/style.css">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="/frontend/css/responsive.css">
        
        <!-- FontAwesome -->
        <!--<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">-->
        <link rel="stylesheet" href="/font-awesome/css/all.css">
        
        <!-- Flags icon -->
        <link rel="stylesheet" href="/frontend/css/flag-icon.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="/frontend/css/custom.css">
        
        <!-- Extra css -->
        @if(!empty($extra_css))
            @foreach($extra_css as $css_file)
                <link rel="stylesheet" href="{{ $css_file }}">
            @endforeach
        @endif
        
        <!-- js variables -->
        <?php if(!empty($js_values)) { ?>
            <script type="text/javascript">
                <?php foreach($js_values as $key => $val) { ?>
                    var <?php echo $key; ?> = <?php echo "'" . $val . "'"; ?>;
                <?php } ?>
            </script>
        <?php } ?>
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        @yield('content')
    </body>
    
    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

    <!-- ALL JS FILES -->
    <script src="/frontend/js/jquery-3.2.1.min.js"></script>
    <script src="/frontend/js/jquery-ui.js"></script>
    <script src="/frontend/js/popper.min.js"></script>
    <script src="/frontend/js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="/frontend/js/jquery.superslides.min.js"></script>
    <script src="/frontend/js/jquery.nicescroll.min.js"></script>
    <script src="/frontend/js/bootstrap-select.js"></script>
    <script src="/frontend/js/inewsticker.js"></script>
    <script src="/frontend/js/bootsnav.js."></script>
    <script src="/frontend/js/images-loded.min.js"></script>
    <script src="/frontend/js/isotope.min.js"></script>
    <script src="/frontend/js/owl.carousel.min.js"></script>
    <script src="/frontend/js/baguetteBox.min.js"></script>
    <script src="/frontend/js/form-validator.min.js"></script>
    <script src="/frontend/js/contact-form-script.js"></script>
    <script src="/frontend/js/custom.js"></script>
    <script src="/frontend/js/cart_products.js"></script>
    <script src="/frontend/js/ajaxLoading.js"></script>
    
    <!-- extra js -->
    @if(!empty($extra_js))
        @foreach($extra_js as $js_file)
            <script src="{{ $js_file }}"></script>
        @endforeach
    @endif
    
    <div class="modal"><!-- Place at bottom of page --></div>
</html>
