<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>       

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mx-auto max-w-7xl sm:px-6 lg:px-8 mt-6" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="py-12 w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Create Role</a>
            </div>
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $role->id }}">
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
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this role?
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table th {
            background-color: #f8fafc;
            font-weight: bold;
            text-transform: uppercase;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9fafb;
        }
        .table-hover tbody tr:hover {
            background-color: #f1f5f9;
        }
        .table a {
            margin-right: 10px;
            text-decoration: none;
            color: #3490dc;
        }
        .table a:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, box-shadow 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #3490dc;
            color: white;
        }
        .btn-primary:hover {
            background-color: #2779bd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-warning {
            background-color: #ffca28;
            color: white;
        }
        .btn-warning:hover {
            background-color: #ffb300;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .btn-danger {
            background-color: #e3342f;
            color: white;
        }
        .btn-danger:hover {
            background-color: #cc1f1a;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }
        .d-inline {
            display: inline;
        }
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid transparent;
        }
        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-dismissible .close {
            position: absolute;
            top: 0;
            right: 0;
            padding: 1.25rem 1rem;
            color: inherit;
        }
    </style>

    <!-- Include jQuery and Bootstrap JS -->
{{--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 --}}    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Script to handle the delete action -->
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var roleId = button.data('id');
            var action = '{{ route('admin.roles.destroy', ':id') }}';
            action = action.replace(':id', roleId);
            $('#deleteForm').attr('action', action);
        });
    </script>
</x-admin-layout>
