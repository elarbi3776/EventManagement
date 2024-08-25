<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mx-auto max-w-4xl sm:px-6 lg:px-8 mt-6" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="flex items-center justify-center h-screen">
        <div class="py-12 w-full max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.permissions.index')}}" class="btn btn-primary">Permission Index</a>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="space-y-8 divide-y divide-gray-200 w-full mx-auto">
                    <form method="POST" action="{{ route('admin.permissions.update', $permission)}}">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" 
                                    value="{{ $permission->name }}" />
                            </div>
                            @error('name') 
                                <span class="text-red-400 text-sm">{{ $message }}</span> 
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-6 p-6 bg-white shadow-md rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Roles</h2>
                <div class="flex flex-wrap gap-2 mb-6">
                    @if ($permission->roles)
                        @foreach ($permission->roles as $permission_role)
                            <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md" method="POST"
                                action="{{ route('admin.permissions.roles.remove', [$permission->id, $permission_role->id]) }}"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ $permission_role->name }}</button>
                            </form>
                        @endforeach
                    @endif
                </div>
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('admin.permissions.roles', $permission->id) }}">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="role" class="block text-sm font-medium text-gray-700">Roles</label>
                            <select id="role" name="role" autocomplete="role-name"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                        <div class="sm:col-span-6 pt-5">
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .btn {
            display: inline-block;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }
        .space-y-8 > * + * {
            margin-top: 2rem;
        }
        .shadow-md {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .rounded-lg {
            border-radius: 0.5rem;
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
</x-admin-layout>
