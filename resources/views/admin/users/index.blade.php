 <x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mx-auto max-w-5xl sm:px-6 lg:px-8 mt-4" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="py-12 w-full max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-gray-900">
                    <table class="min-w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-6 py-3 border-b border-gray-300 text-left leading-4 text-gray-600 uppercase tracking-wider">Avatar</th>
                                <th class="px-6 py-3 border-b border-gray-300 text-left leading-4 text-gray-600 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 border-b border-gray-300 text-left leading-4 text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 border-b border-gray-300 text-left leading-4 text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                             <img src="{{ $user->avatar ? asset('storage/' . config('chatify.user_avatar.folder') . '/' . $user->avatar) : asset('storage/' . config('chatify.user_avatar.folder') . '/' . config('chatify.user_avatar.default')) }}" 
                                             alt="User Avatar" 
                                             class="rounded-full" 
                                             style="width: 40px; height: 40px;">

                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $user->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">{{ $user->email }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-300">
                                        <a href="{{ route('admin.users.show', $user->id)}}" class="btn btn-info">Roles</a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $user->id }}">
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
                    Are you sure you want to delete this user?
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
        .btn {
            display: inline-block;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .btn-info {
            background-color: #17a2b8;
            color: white;
        }
        .btn-info:hover {
            background-color: #117a8b;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .inline-block {
            display: inline-block;
        }
        .min-w-full {
            width: 100%;
        }
        .table-auto {
            table-layout: auto;
        }
        .border-collapse {
            border-collapse: collapse;
        }
        .border-b {
            border-bottom-width: 1px;
        }
        .border-gray-300 {
            border-color: #d1d5db;
        }
        .whitespace-no-wrap {
            white-space: nowrap;
        }
        .bg-gray-200 {
            background-color: #edf2f7;
        }
        .bg-gray-100 {
            background-color: #f7fafc;
        }
        .hover\:bg-gray-100:hover {
            background-color: #f7fafc;
        }
        .leading-4 {
            line-height: 1.25;
        }
        .uppercase {
            text-transform: uppercase;
        }
        .tracking-wider {
            letter-spacing: 0.05em;
        }
        .text-gray-600 {
            color: #718096;
        }
        .text-left {
            text-align: left;
        }
        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }
        .alert {
            padding: 10px 15px;
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
            var userId = button.data('id');
            var action = '{{ route('admin.users.destroy', ':id') }}';
            action = action.replace(':id', userId);
            $('#deleteForm').attr('action', action);
        });
    </script>
</x-admin-layout>
