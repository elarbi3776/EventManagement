<x-app-layout>
    <!-- Container to prevent hiding under navbar -->
    <div class="content-container">
        <!-- Message d'erreur -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Program Section -->
        <section id="program" class="parallax-section text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="wow fadeInUp col-md-12 col-sm-12" data-wow-delay="0.6s">
                        <div class="section-title center-content">
                            <h2>Our Programs</h2>
                            <p>Discover our latest events and join us.</p>
                        </div>
                    </div>

                    <div class="wow fadeInUp col-md-12 col-sm-12" data-wow-delay="0.9s">
                        <ul class="nav nav-tabs justify-content-center category-tabs" role="tablist">
                            @php
                                $categories = $events->pluck('category')->unique();
                            @endphp
                            @foreach($categories as $index => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{ $index == 0 ? 'active' : '' }}" href="#category-{{ $index }}" aria-controls="category-{{ $index }}" role="tab" data-toggle="tab">{{ $category }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content text-center">
                            @foreach($categories as $index => $category)
                                <div role="tabpanel" class="tab-pane fade {{ $index == 0 ? 'show active' : '' }}" id="category-{{ $index }}">
                                    <div class="row justify-content-center">
                                        @foreach($events->where('category', $category) as $event)
                                            <div class="col-md-3 col-sm-6 d-flex justify-content-center">
                                                <div class="event-item">
                                                    <div class="event-image">
                                                        <img src="{{ asset('storage/' . $event->photo1) }}" class="img-responsive" alt="{{ $event->name }}">
                                                    </div>
                                                    <div class="event-content">
                                                        <h3>{{ $event->name }}</h3>
                                                        <div class="time-location">
                                                            <div class="time-entry">
                                                                <span><i class="fa fa-clock-o"></i> From: {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y H:i') }}</span>
                                                            </div>
                                                            <div class="time-entry">
                                                                <span><i class="fa fa-clock-o"></i> To: {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y H:i') }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="time-location">
                                                            <span><i class="fa fa-map-marker"></i> {{ $event->location }}</span>
                                                        </div>
                                                        <a href="#" class="btn btn-primary mt-2 reserve-btn" data-event-id="{{ $event->id }}">Reserve</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Stylish Reservation Confirmation Modal -->
    <div class="modal-backdrop" id="modalBackdrop"></div>
    <div class="modal fade" id="confirmReservationModal" tabindex="-1" role="dialog" aria-labelledby="confirmReservationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center" id="confirmReservationModalLabel">Confirm Your Reservation</h5>
                    <button type="button" class="close" aria-label="Close">
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
                    <button type="button" class="btn btn-secondary cancel-btn">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmReservationButton">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var eventId;
            var confirmReservationModal = document.getElementById('confirmReservationModal');
            var confirmReservationButton = document.getElementById('confirmReservationButton');
            var closeModalButtons = document.querySelectorAll('.close, .cancel-btn');
            var modalBackdrop = document.getElementById('modalBackdrop');
            var contentContainer = document.querySelector('.content-container');

            document.querySelectorAll('.reserve-btn').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent the default anchor behavior
                    eventId = button.getAttribute('data-event-id');
                    confirmReservationModal.classList.add('show');
                    confirmReservationModal.style.display = 'block';
                    modalBackdrop.classList.add('show');
                    contentContainer.classList.add('blurred'); // Add blurring effect
                });
            });

            confirmReservationButton.addEventListener('click', function() {
                window.location.href = '/participant/events/reserve/' + eventId;
            });

            closeModalButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    confirmReservationModal.classList.remove('show');
                    confirmReservationModal.style.display = 'none';
                    modalBackdrop.classList.remove('show');
                    contentContainer.classList.remove('blurred'); // Remove blurring effect
                });
            });

            window.addEventListener('click', function(event) {
                if (event.target === confirmReservationModal) {
                    confirmReservationModal.classList.remove('show');
                    confirmReservationModal.style.display = 'none';
                    modalBackdrop.classList.remove('show');
                    contentContainer.classList.remove('blurred'); // Remove blurring effect
                }
            });
        });
    </script>

    <style>
        .content-container {
            padding-top: 10px; /* Adjust this value based on your navbar height */
        }

        .event-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
            transition: transform 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            height: 90%;
            min-height: 450px;
            align-items: center;
        }

        .event-item:hover {
            transform: translateY(-10px);
        }

        .event-image img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .event-content {
            padding: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }

        .event-content h3 {
            font-size: 20px;
            margin: 10px 0;
        }

        .time-location {
            font-size: 14px;
            color: #999;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            display: inline-block;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .nav-tabs {
            margin-bottom: 20px;
        }

        .nav-tabs .nav-item .nav-link {
            color: #555;
            border: none;
            border-radius: 0;
            margin-right: 5px;
            padding: 10px 20px;
            background-color: transparent;
            transition: color 0.3s ease, border-bottom 0.3s ease;
        }

        .nav-tabs .nav-item .nav-link:hover {
            color: #000;
            border-bottom: 2px solid #007bff;
        }

        .nav-tabs .nav-item .nav-link.active {
            color: #000;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
        .alert-dismissible .close {
            position: relative;
            top: -0.75rem;
            right: -0.75rem;
            padding: 0.75rem;
            color: inherit;
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

        .modal.fade {
            transition: opacity 0.15s linear;
        }
        .modal.show {
            opacity: 1;
        }

        /* Backdrop for the modal */
        .modal-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1040;
        }
        .modal-backdrop.show {
            display: block;
        }

        /* Blur effect */
        .blurred {
            filter: blur(5px);
            transition: filter 0.3s ease-in-out;
        }
    </style>
</x-app-layout>
