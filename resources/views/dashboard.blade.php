<x-app-layout>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-auto mt-4" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <style>
        .event-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            width: 350px;
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
            position: relative;
        }

        .event-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .event-card .content {
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .event-card h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #007bff;
        }

        .event-card .details {
            font-size: 14px;
            color: #555;
            margin-top: 10px;
        }

        .event-card .details div {
            margin-bottom: 5px;
        }

        .event-card:hover {
            transform: translateY(-10px);
        }

        .events-grid {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .section-title {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Slick Carousel Styles */
        .carousel-container {
            max-width: 1200px; /* Ajustez la largeur maximale selon vos besoins */
            margin: 0 auto; /* Centre le conteneur horizontalement */
            padding: 20px; /* Ajoute un peu d'espace autour du carrousel */
        }

        .carousel {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .carousel img {
            width: 100%;
            height: auto;
            max-height: 500px; /* Ajuste la hauteur maximale des images si nécessaire */
        }
    </style>

    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    <section id="carousel" class="parallax-section">
        <div class="carousel-container">
            <div class="carousel">
                @foreach($carouselImages as $image)
                    <div>
                        <img src="{{ asset('storage/' . $image) }}" alt="Annonce">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.carousel').slick({
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                dots: true,
                arrows: false
            });
        });
    </script>

    <div class="container">
        <section id="events" class="parallax-section">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12 wow bounceIn">
                    <div class="section-title">
                        <h2>Upcoming Events</h2>
                        <p>Discover our latest events and join us.</p>
                    </div>
                </div>
            </div>

            <div class="events-grid">
                @foreach($events as $event)
                    <div class="event-card wow fadeInUp" data-wow-delay="0.9s">
                        <a href="{{ route('events.detail', $event->id) }}">
                            <img src="{{ asset('storage/' . $event->photo1) }}" alt="{{ $event->name }}">
                            <div class="content">
                                <h3>{{ $event->name }}</h3>
                                <div class="details">
                                    <div><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</div>
                                    <div><i class="fas fa-calendar-alt"></i> Du {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }} au {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}</div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>




