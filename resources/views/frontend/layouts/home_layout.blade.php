<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="https://pandora.pe/ugel/assets/img/faviconx72.png" />
    <!-- CSS ugel ILO-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <link href="css/form-validation.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/checkout/">

    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')  }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">


    <script src="https://kit.fontawesome.com/3809eab31a.js" crossorigin="anonymous"></script>
</head>
<style>
    .chatbot {
        position: fixed;
        z-index: 99999999;
        bottom: 100px !important;
        right: 10px;
    }
</style>

@include('frontend.layouts.home_header')

<body>

    @include('frontend.layouts.home_nav')

    @yield('content')

    @include('frontend.layouts.home_footer')


    {{-- <script src="{{ url('js/owl.carousel.js') }}"></script> --}}
    {{-- <script>
        $(document).ready(function() {
    $('#casos .owl-carousel').owlCarousel({
      autoplay: false,
      autoplayHoverPause: true,
      items: 6,
      nav: true,
      dots: false,
      loop: false,
      margin: 10,
      responsiveClass: true,
      responsive: {
        0: {
          items: 2,
          nav: false,
          dots: false,
          loop: true,
          autoplay: true,
        },
        600: {
          items: 6,
          nav: false,
          dots: false,
          loop: true,
          autoplay: true,
        },
        1000: {
          items: 6,
          nav: false,
          loop: true,
          margin: 20,
          autoplay: true,
        }
      }
    })
  })
  $(document).ready(function() {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
    })
    myModal.show();
  })
    </script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</body>



</html>
