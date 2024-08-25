<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.permissions.index')}}" class="btn btn-primary">Permission Index</a>
            </div>
            <form method="POST" action="{{ route('admin.permissions.store')}}">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Permission Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full bg-gray-50 border border-gray-300 rounded-md py-2 px-3 shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        @error('name') 
                            <span class="text-red-400 text-sm">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div class="pt-5">
                        <button type="submit" class="btn btn-success w-full">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        .btn {
            display: inline-block;
            padding: 10px 15px;
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
    </style>
</x-admin-layout>
