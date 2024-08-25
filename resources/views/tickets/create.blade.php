<x-app-layout>
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white text-center py-4">
                <h2 class="font-weight-bold">Ticket for {{ $event->name }}</h2>
            </div>
            <div class="card-body p-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="ticketForm" action="{{ route('participant.tickets.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                    <!-- Event Details -->
                    <div class="mb-4">
                        <h4>Event Details</h4>
                        <p><strong>Name:</strong> {{ $event->name }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y H:i') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y H:i') }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                    </div>

                    <!-- User Details -->
                    <div class="mb-4">
                        <h4>User Details</h4>
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    </div>

                    <!-- Attendee Name -->
                    <div class="mb-4">
                        <label for="attendee_name" class="form-label">Attendee Name:</label>
                        <input type="text" id="attendee_name" name="attendee_name" class="form-control" value="{{ old('attendee_name', Auth::user()->name) }}" required>
                    </div>

                    <button id="confirmButton" class="btn btn-success btn-block" type="submit">Get my ticket</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Downloading Ticket -->
    @if(session('success') && session('qrCodeDataUri'))
    <div class="modal fade show" id="downloadTicketModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Your Ticket</h5>
                    <button type="button" class="close-modal-button">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <!-- QR Code -->
                    <div class="qr-code">
                        <img src="{{ session('qrCodeDataUri') }}" alt="QR Code" class="animated-zoom">
                    </div>
                    <p class="mt-3">Scan this QR code to access your ticket details.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('participant.download.ticket', ['ticket' => session('ticket_id')]) }}" class="btn btn-success">
                        Download Ticket
                    </a>
                    <button type="button" class="btn btn-secondary close-modal-button">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success') && session('qrCodeDataUri'))
                document.getElementById('downloadTicketModal').style.display = 'block';
                document.body.classList.add('modal-open');
            @endif

            document.querySelectorAll('.close-modal-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    document.getElementById('downloadTicketModal').style.display = 'none';
                    document.body.classList.remove('modal-open');
                });
            });
        });

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('downloadTicketModal');
            if (event.target === modal) {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        };
    </script>

    <!-- Custom Styles -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
            color: white;
        }

        .card {
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #495057;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
            border-radius: 50px;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .qr-code img {
            border-radius: 10px;
            border: 2px solid #007bff;
            padding: 10px;
            background-color: #f8f9fa;
            transition: transform 0.3s ease;
        }

        .qr-code img.animated-zoom {
            animation: zoom-in 0.5s ease forwards;
        }

        @keyframes zoom-in {
            from {
                transform: scale(0.7);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0;
            background-color: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .modal.fade.show {
            opacity: 1;
        }

        .modal-dialog {
            position: relative;
            margin: auto;
            padding: 20px;
            width: 100%;
            max-width: 500px;
            transform: translateY(-50px);
            transition: transform 0.5s ease-in-out;
        }

        .modal.fade.show .modal-dialog {
            transform: translateY(0);
        }

        .modal-content {
            background-color: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-bottom: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 15px 15px 0 0;
        }

        .close-modal-button {
            background: none;
            border: none;
            font-size: 1.5em;
            color: white;
            cursor: pointer;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding-top: 10px;
            border-top: none;
        }

        .modal-footer .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        /* Modal open class to prevent scrolling */
        body.modal-open {
            overflow: hidden;
        }
    </style>
</x-app-layout>



{{-- <x-app-layout>
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white text-center py-4">
                <h2 class="font-weight-bold">Ticket for {{ $event->name }}</h2>
            </div>
            <div class="card-body p-5">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form id="ticketForm" action="{{ route('participant.tickets.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">

                    <!-- Event Details -->
                    <div class="mb-4">
                        <h4>Event Details</h4>
                        <p><strong>Name:</strong> {{ $event->name }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y H:i') }} - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y H:i') }}</p>
                        <p><strong>Location:</strong> {{ $event->location }}</p>
                    </div>

                    <!-- User Details -->
                    <div class="mb-4">
                        <h4>User Details</h4>
                        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    </div>

                    <!-- Attendee Name -->
                    <div class="mb-4">
                        <label for="attendee_name" class="form-label">Attendee Name:</label>
                        <input type="text" id="attendee_name" name="attendee_name" class="form-control" value="{{ old('attendee_name', Auth::user()->name) }}" required>
                    </div>

                    <button id="confirmButton" class="btn btn-success btn-block" type="submit">Get my ticket</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for Downloading Ticket -->
    @if(session('success') && session('qrCodeDataUri'))
    <div class="modal fade" id="downloadTicketModal" tabindex="-1" role="dialog" aria-labelledby="downloadTicketModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="downloadTicketModalLabel">Your Ticket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <!-- QR Code -->
                    <div class="qr-code">
                        <img src="{{ session('qrCodeDataUri') }}" alt="QR Code" style="width: 200px; height: auto;">
                    </div>
                    <p class="mt-3">Scan this QR code to access your ticket details.</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('participant.download.ticket', ['ticket' => session('ticket_id')]) }}" class="btn btn-success">
                        Download Ticket
                    </a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            @if(session('success') && session('qrCodeDataUri'))
                $('#downloadTicketModal').modal('show');
            @endif
        });
    </script>

    <!-- Custom Styles -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
            color: white;
        }

        .card {
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            color: #495057;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s;
            border-radius: 50px;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .qr-code img {
            border-radius: 10px;
            border: 2px solid #007bff;
            padding: 10px;
            background-color: #f8f9fa;
        }

        .modal-header {
            background-color: #007bff;
            color: white;
        }

        .modal-footer .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .modal-footer .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</x-app-layout>
 --}}