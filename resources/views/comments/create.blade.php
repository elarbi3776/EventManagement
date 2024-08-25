<x-app-layout>
    @section('content')
        <div class="container my-5">
            <div class="bg-white p-5 rounded-lg shadow-lg">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Comments for {{ $event->name }}</h1>
                <form action="{{ route('participant.comments.store', $event->id) }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="content" class="block text-gray-700 text-sm font-semibold mb-2">Your Comment</label>
                        <textarea name="content" id="content" class="w-full p-4 border border-gray-300 rounded-md focus:ring focus:ring-blue-200" rows="4" required></textarea>
                    </div>
                    <div>
                        <label for="rating" class="block text-gray-700 text-sm font-semibold mb-2">Rating</label>
                        <select name="rating" id="rating" class="w-full p-4 border border-gray-300 rounded-md focus:ring focus:ring-blue-200" required>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-md font-semibold hover:bg-blue-700">Submit</button>
                </form>
            </div>
        </div>

        <style>
            .container {
                max-width: 700px;
                margin: 0 auto;
            }

            .bg-white {
                background-color: #ffffff;
            }

            .rounded-lg {
                border-radius: 0.5rem;
            }

            .shadow-lg {
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            }

            .text-3xl {
                font-size: 1.875rem;
                line-height: 2.25rem;
            }

            .text-gray-800 {
                color: #2d3748;
            }

            .space-y-6 > :not([hidden]) ~ :not([hidden]) {
                margin-top: 1.5rem;
            }

            .border {
                border-width: 1px;
            }

            .border-gray-300 {
                border-color: #d2d6dc;
            }

            .rounded-md {
                border-radius: 0.375rem;
            }

            .focus\:ring {
                outline: 2px solid transparent;
                outline-offset: 2px;
            }

            .focus\:ring-blue-200 {
                --tw-ring-color: #bfdbfe;
                box-shadow: 0 0 0 4px var(--tw-ring-color);
            }

            .bg-blue-600 {
                background-color: #2563eb;
            }

            .hover\:bg-blue-700:hover {
                background-color: #1d4ed8;
            }

            .font-semibold {
                font-weight: 600;
            }

            .py-3 {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }

            .px-4 {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        </style>
    @endsection
</x-app-layout>
