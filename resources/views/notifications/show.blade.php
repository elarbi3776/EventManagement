<!-- resources/views/notifications/show.blade.php -->

<x-app-layout>
    <div class="container mx-auto py-8">
        <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">{{ $notification->data['name'] }}</h1>
            <p class="text-gray-700 mb-4">{{ $notification->data['message'] ?? 'No additional message.' }}</p>
            <p class="text-gray-500 text-sm mb-6"><small>{{ $notification->created_at->diffForHumans() }}</small></p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back to Dashboard</a>        </div>
    </div>
</x-app-layout>
