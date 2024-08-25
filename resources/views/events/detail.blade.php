<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <div class="container mt-0">
        <div class="card" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="row no-gutters">
                <div class="col-md-2 text-center" style="background-color: #f8f9fa; border-top-left-radius: 10px; border-bottom-left-radius: 10px; padding: 15px;">
                    <div style="background-color: #28a745; color: white; border-radius: 5px; padding: 5px;">
                        <span style="display: block; font-size: 0.9rem;">{{ strtoupper(\Carbon\Carbon::parse($event->start_date)->format('M')) }}</span>
                        <span style="font-size: 2rem; font-weight: bold;">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="card-body" style="padding: 20px;">
                        <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold;">
                            <i class="fas fa-calendar-alt" style="color: #007bff;"></i>
                            {{ $event->name }} - {{ \Carbon\Carbon::parse($event->start_date)->isoFormat('dddd D MMMM YYYY [à] HH:mm') }}
                        </h5>
                        <p class="card-text" style="font-size: 1rem; margin-bottom: 10px;">
                            <i class="fas fa-map-marker-alt" style="color: #101010; margin-right: 5px;"></i> 
                            {{ $event->location }}
                        </p>
                        <div class="d-flex">
                            <img src="{{ asset('storage/' . $event->photo1) }}" class="img-fluid mb-3" alt="{{ $event->name }}" style="border-radius: 10px; object-fit: cover; width: 45%; margin-right: 10px;">
                            <img src="{{ asset('storage/' . $event->photo2) }}" class="img-fluid mb-3" alt="{{ $event->name }}" style="border-radius: 10px; object-fit: cover; width: 45%;">
                        </div>
                        <div class="card-text" style="font-size: 1rem; margin-bottom: 10px; border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f9f9f9;">
                            {{ $event->description }}
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary" style="background-color: #007bff; border: none;">Back</a>
                            <button class="btn btn-success" style="background-color: #28a745; border: none;" data-toggle="modal" data-target="#confirmReservationModal">Reserve</button>
                            <a href="{{ route('participant.comments.create', $event->id) }}" class="btn btn-info" style="background-color: #17a2b8; border: none; color: white; padding: 10px 20px; border-radius: 5px; font-size: 1rem; text-transform: uppercase;">
                                <i class="fas fa-comment-dots" style="margin-right: 5px;"></i> Add Comment
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nouveau conteneur pour la carte -->
        <div class="card mt-4" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold; text-align: center;">
                    <i class="fas fa-map-marker-alt" style="color: #007bff;"></i> Event Location
                </h5>
                <div id="map" style="height: 400px; width: 100%; border-radius: 10px;"></div>
            </div>
        </div>
    </div>

    <!-- Stylish Reservation Confirmation Modal -->
    <div class="modal fade" id="confirmReservationModal" tabindex="-1" role="dialog" aria-labelledby="confirmReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center" id="confirmReservationModalLabel">Confirm Your Reservation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="modal-icon mb-3">
                        <i class="fas fa-calendar-check fa-3x text-success"></i>
                    </div>
                    <p class="lead">Are you sure you want to reserve this event?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="{{ route('participant.events.reserve', $event->id) }}" class="btn btn-primary">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=YourApiKey" async defer></script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        function initMap() {
            const eventLatitude = @json($event->latitude);
            const eventLongitude = @json($event->longitude);
            const eventName = @json($event->name);

            const latitude = eventLatitude || 48.8566;
            const longitude = eventLongitude || 2.3522;

            const eventLocation = { lat: latitude, lng: longitude };

            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: eventLocation
            });

            new google.maps.Marker({
                position: eventLocation,
                map: map,
                title: eventName
            });
        }

        initMap();
      });
    </script>

    <style>
        .card {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: white;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.5rem;
            color: #333;
        }

        #map {
            margin-top: 20px;
        }

        /* Styles for the Stylish Modal */
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        .modal-icon i {
            color: #28a745;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
</x-app-layout>
