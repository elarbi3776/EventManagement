<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Events</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
{{--     <link rel="stylesheet" href="css/owl.carousel.css">
 --}}    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">
</head>
<body data-spy="scroll" data-offset="50" data-target=".navbar-collapse">

    <!-- Preloader -->
    <div class="preloader">
        <div class="sk-rotating-plane"></div>
    </div>

    @include('homeNavigation')

    <!-- Intro Section -->
    <section id="intro" class="parallax-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h1 class="wow fadeInUp" data-wow-delay="1.6s">Events</h1>
                    <div class="button-group">
                        <a href="#overview" class="btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs" data-wow-delay="2.3s">LEARN MORE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <!-- Program Section -->
    <section id="program" class="parallax-section text-center">
        <div class="container">
            <div class="wow fadeInUp col-md-12 col-sm-12" data-wow-delay="0.9s">
                <div class="owl-carousel event-carousel">
                    @foreach($events as $event)
                        <div class="item">
                            <img src="{{ asset('storage/' . $event->photo1) }}" class="img-responsive event-image" alt="{{ $event->name }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section> --}}

    @include('layouts.footer')

    <!-- Back to Top -->
    <a href="#back-top" class="go-top"><i class="fa fa-angle-up"></i></a>

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.parallax.js"></script>
{{--     <script src="js/owl.carousel.min.js"></script>
 --}}    <script src="js/smoothscroll.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/custom.js"></script>
   {{--  <script>
        $(document).ready(function(){
            $(".event-carousel").owlCarousel({
                loop: true,
                margin: 0,
                nav: true,
                navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true,
                items: 1,
                animateOut: 'fadeOut'
            });
        });
    </script> --}}

   {{--  <!-- Inline Styles -->
    <style>
        .event-carousel .owl-nav i {
            font-size: 2rem;
            color: #ffffff;
        }
        .event-carousel .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .event-carousel .owl-nav [class*='owl-'] {
            background: transparent;
        }
        .event-carousel .item {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 500px;
        }
        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0;
        }
    </style>
     --}}
</body>
</html>
