<x-layouts.organizer>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('organizer.events.create') }}" class="btn btn-primary mb-4">Create Event</a>
                <div class="table-responsive">
                    <table class="styled-table mt-4">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Available Tickets</th>
                                <th>Photos</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($event->end_date)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $event->location }}</td>
                                    <td>{{ $event->category }}</td>
                                    <td>{{ $event->available_tickets }}</td>
                                    <td>
                                        @if($event->photo1)
                                            <img src="{{ asset('storage/' . $event->photo1) }}" alt="Photo 1" width="50" class="img-thumbnail">
                                        @else
                                            N/A
                                        @endif
                                        @if($event->photo2)
                                            <img src="{{ asset('storage/' . $event->photo2) }}" alt="Photo 2" width="50" class="img-thumbnail">
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('organizer.events.edit', $event) }}" class="btn btn-warning btn-sm mb-2">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $event->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this event?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn {
            display: inline-block;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-warning {
            background-color: #ffc107;
            color: black;
        }
        .btn-warning:hover {
            background-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin: 25px 0;
            font-family: 'Roboto', sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }
        .styled-table th, .styled-table td {
            padding: 12px 15px;
        }
        .styled-table thead tr {
            background-color: #343a40;
            color: white;
            text-align: left;
        }
        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }
        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }
        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #343a40;
        }
        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #343a40;
        }
        .img-thumbnail {
            border: 1px solid #dee2e6;
            padding: .25rem;
            background-color: #f9f9f9;
            border-radius: .25rem;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .mb-4 {
            margin-bottom: 1.5rem;
        }
        .mb-2 {
            margin-bottom: 0.75rem;
        }
        .p-6 {
            padding: 1.5rem;
        }
        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-dismissible .close {
            position: relative;
            top: -0.75rem;
            right: -0.75rem;
            padding: 0.75rem;
            color: inherit;
        }
    </style>

    <!-- Include Bootstrap 5 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- Script to handle the delete action -->
    <script>
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var eventId = button.getAttribute('data-id');
            var action = '{{ route('organizer.events.destroy', ':id') }}';
            action = action.replace(':id', eventId);
            document.getElementById('deleteForm').action = action;
        });
    </script>
</x-layouts.organizer>







