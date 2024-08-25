<x-app-layout>
    <div class="container mx-auto p-6 bg-gray-100">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">My Reservations</h2>

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                <div class="flex items-center">
                    <svg class="fill-current h-6 w-6 text-green-500 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10 15a1.5 1.5 0 01-1.5-1.5h3A1.5 1.5 0 0110 15zm-4-3a1 1 0 011-1h6a1 1 0 011 1v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-1zM2 5a1 1 0 011-1h14a1 1 0 011 1v1a1 1 0 01-1 1H3a1 1 0 01-1-1V5zm15 4a1 1 0 01-1-1V7a1 1 0 011-1h1a1 1 0 011 1v1a1 1 0 01-1 1h-1zM3 10a1 1 0 011-1h12a1 1 0 011 1v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-1z" />
                    </svg>
                    <div>
                        <p class="font-semibold">Success!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="relative overflow-x-auto shadow-lg sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gradient-to-r from-gray-50 to-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Event</th>
                        <th scope="col" class="px-6 py-3">Event Date</th>
                        <th scope="col" class="px-6 py-3">Reservation Date</th>
                        <th scope="col" class="px-6 py-3">Location</th>
                        <th scope="col" class="px-6 py-3 text-right">
                            <span class="sr-only">Actions</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-purple-600 dark:text-purple-400">
                                {{ $reservation->event->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $reservation->event->start_date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->created_at }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $reservation->event->location }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-4">
                                    <button type="button" class="font-medium text-white bg-red-500 hover:bg-red-600 rounded-lg px-4 py-2 transition" onclick="openConfirmationModal({{ $reservation->id }})">
                                        Cancel
                                    </button>
                                    @if($reservation->ticket)
                                        <a href="{{ route('participant.download.ticket', $reservation->ticket->id) }}" class="font-medium text-blue-500 bg-white border border-blue-500 hover:bg-blue-500 hover:text-white rounded-lg px-4 py-2 transition">
                                            Download Ticket
                                        </a>
                                    @else
                                        <span class="text-gray-400">No Ticket Available</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Stylish Cancellation Confirmation Modal -->
    <div class="modal fade" id="confirmCancelModal" tabindex="-1" role="dialog" aria-labelledby="confirmCancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title w-100 text-center" id="confirmCancelModalLabel">Confirm Cancellation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="modal-icon mb-3">
                        <i class="fas fa-exclamation-triangle fa-3x text-warning"></i>
                    </div>
                    <p class="lead">Are you sure you want to cancel this reservation?</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Keep It</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary bg-red-500 text-white rounded-lg px-4 py-2">Yes, Cancel It</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openConfirmationModal(reservationId) {
            document.getElementById('deleteForm').action = `/participant/reservations/${reservationId}`;
            $('#confirmCancelModal').modal('show');
        }
    </script>

    <style>
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-primary {
            background-color: #d9534f;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            color: white;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #c9302c;
        }
    </style>
</x-app-layout>
