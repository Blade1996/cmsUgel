<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css') }}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/animate.min.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/meanmenu.min.css') }}">
    <!-- Line Awesome CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css') }}">
    <!-- Magnific CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css') }}">
    <!-- Owl Theme CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/owl.theme.default.min.css') }}">
    <!-- Odometer CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/odometer.css') }}">
    <!-- Stylesheet CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
    <!-- Stylesheet Responsive CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/responsive.css') }}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png') }}">
    <!-- Title -->
    <title>@yield('title')</title>
</head>

<body>
    <!-- Preloder Area -->
    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="lds-hourglass"></div>
            </div>
        </div>
    </div>
    <!-- End Preloder Area -->

    <!-- Heder Area -->
    @include('frontend.layouts.home_header')
    <!-- End Heder Area -->

    @yield('content')

    <!-- Footer Area-->
    @include('frontend.layouts.home_footer')
    <!-- End Footer Area -->

    <!-- Footer bottom Area -->
    <div class="footer-bottom">
        <div class="container">
            <p>Copyright @2022 UGEL ILO. Todos lo derechos reservados <a href="#" target="_blank">Maqa
                    Consulting</a></p>
        </div>
    </div>
    <!-- End Footer bottom Area -->

    {{--
    <!-- Go Top -->
    <div class="go-top">
        <i class="las la-hand-point-up"></i>
    </div> --}}
    <!-- End Go Top -->

    <!-- jQuery first, then Bootstrap JS -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Meanmenu JS -->
    <script src="{{asset('assets/js/meanmenu.min.js')}}"></script>
    <!-- Magnific JS -->
    <script src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <!-- Odometer JS -->
    <script src="{{asset('assets/js/odometer.min.js')}}"></script>
    <!-- Appear JS -->
    <script src="{{asset('assets/js/jquery.appear.js')}}"></script>
    <!-- Form Validator JS -->
    <script src="{{asset('assets/js/form-validator.min.js')}}"></script>
    <!-- Contact JS -->
    <script src="{{asset('assets/js/contact-form-script.js')}}"></script>
    <!-- Ajaxchimp JS -->
    <script src="{{asset('assets/js/jquery.ajaxchimp.min.js')}}"></script>
    <!-- Custom JS -->
    <script src="{{asset('assets/js/custom.js')}}"></script>
</body>

</html>
