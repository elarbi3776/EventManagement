<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mx-auto max-w-7xl sm:px-6 lg:px-8 mt-4" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="flex items-center justify-center h-screen">
        <div class="py-12 w-full max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.users.index')}}" class="btn btn-primary">Users Index</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="user-info-box p-4 mb-6">
                    <div class="text-lg font-semibold">User Name: <span class="text-gray-700">{{ $user->name }}</span></div>
                    <div class="text-lg font-semibold">User Email: <span class="text-gray-700">{{ $user->email }}</span></div>
                </div>
                <div class="bg-slate-100 p-6 rounded-lg">
                    <h2 class="text-2xl font-semibold mb-4">Roles</h2>
                    <div class="flex flex-wrap space-x-2 mb-4">
                        @if ($user->roles)
                            @foreach ($user->roles as $user_role)
                                <form method="POST" action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-2">{{ $user_role->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <form method="POST" action="{{ route('admin.users.roles', $user->id) }}" class="flex items-center space-x-2">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="role" class="block text-sm font-medium text-gray-700">Assign Role</label>
                            <select id="role" name="role" autocomplete="role-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <button type="submit" class="btn btn-success">Assign</button>
                        </div>
                    </form>
                </div>

                <div class="mt-6 bg-slate-100 p-6 rounded-lg">
                    <h2 class="text-2xl font-semibold mb-4">Permissions</h2>
                    <div class="flex flex-wrap space-x-2 mb-4">
                        @if ($user->permissions)
                            @foreach ($user->permissions as $user_permission)
                                <form method="POST" action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mb-2">{{ $user_permission->name }}</button>
                                </form>
                            @endforeach
                        @endif
                    </div>
                    <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}" class="flex items-center space-x-2">
                        @csrf
                        <div class="sm:col-span-6">
                            <label for="permission" class="block text-sm font-medium text-gray-700">Assign Permission</label>
                            <select id="permission" name="permission" autocomplete="permission-name" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            @error('permission')
                                <span class="text-red-400 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <button type="submit" class="btn btn-success">Assign</button>
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
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .user-info-box {
            border: 1px solid #dcdcdc;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .user-info-box .text-lg {
            margin-bottom: 10px;
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
</x-admin-layout>
