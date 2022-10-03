<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ $companyData->companyInfo->url_icon }}" />
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

    #enlacesdeinteres a {
        text-decoration: none;
        padding: 5px;
        background-color: rgb(13 110 253 / 25%);
        font-size: 14px;
        margin: 0 0 10px;
        display: block;
    }

    #myCarousel .carousel-inner div {
        min-height: 600px;
    }

    #myCarousel .carousel-inner div {
        min-height: 600px;
    }

    .carousel-caption {
        top: 80px;
    }

    .pagination {
        flex-wrap: wrap;
    }

    .modal-body {
        position: relative;
    }

    .carousel,
    .item,
    .active {
        height: 100%;
    }

    .carousel-inner {
        height: 100%;
    }

    .modal-dialog {
        width: 100vh !important;
        height: 100% !important;
        max-width: 960px !important;
    }
</style>

@include('frontend.layouts.home_header')

<body>

    @include('frontend.layouts.home_nav')

    @yield('content')

    @include('frontend.layouts.home_footer')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    {{-- <script src="js/scripts.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <!-- DataTables -->
    <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>


    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script>
        $(document).ready(function() {
            if(window.location.pathname == '/'){
                $('#casos .owl-carousel').owlCarousel({
                    autoplay: false,
                    autoplayHoverPause: true,
                    items: 6,
                    nav: true,
                    dots: false,
                    height: 600,
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

                    $('#pedagogicCarousel').carousel({
                        interval: 5000,
                    });

                    $(document).ready(function() {
                        let count = $('input[name="countModal"]').val();

                        if(count > 0){
                            var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {});
                            myModal.show();

                            $('').owlCarousel({
                                items: count,
                                nav: true,

                            })

                            $('#exampleModal .carousel').carousel()

                        }



                    })

                }

    $("#searchBar").submit(function(e) {
        e.preventDefault();
        let valueSearch = $('input[type=search]').val();
        location.href = `/articulos?search=${valueSearch}`;
    });

    $(document).on('change', "#category", function() {
        let categoryId = $(this).val();
        let type = $(this).attr('type');
        $.ajax({
            type:'GET',
            url: '/document/find',
            data: {type, categoryId},
            dataType: 'json',
            success: function(response){
                $('#resultado-filtro').html(response);
            }
        });
    })

    $('#announcenentsTable').dataTable({
      responsive: true,
      order: [],
    });
  })

    </script>
</body>



</html>
