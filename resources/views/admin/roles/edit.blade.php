<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
                <a href="{{ route('admin.roles.index')}}" class="btn btn-primary">Role Index</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mx-auto">
                    <form method="POST" action="{{ route('admin.roles.update', $role->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Role Name</label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" value="{{ $role->name }}"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
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

            <div class="mt-6 p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Role Permissions</h2>
                <div class="flex space-x-2 mb-6">
                    @if ($role->permissions)
                        @foreach ($role->permissions as $role_permission)
                            <form class="px-4 py-2 bg-gray-200 rounded-md" method="POST"
                                action="{{ route('admin.roles.permissions.revoke', [$role->id, $role_permission->id]) }}"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ $role_permission->name }}</button>
                            </form>
                        @endforeach
                    @endif
                </div>
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('admin.roles.permissions', $role->id) }}">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="permission" class="block text-sm font-medium text-gray-700">Permission</label>
                            <select id="permission" name="permission" autocomplete="permission-name"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('name')
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
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dcdc35;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c8bd23;
        }
        .space-y-8 > * + * {
            margin-top: 2rem;
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
