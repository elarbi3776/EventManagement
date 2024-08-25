<!-- resources/views/events/edit.blade.php -->

<x-layouts.organizer>
    <x-slot name="header">
        <div class="bg-primary py-4">
            <h2 class="font-semibold text-xl text-white leading-tight text-center">
                {{ __('Edit Event') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary text-white text-center">
                            <h5 class="mb-0">Edit Event</h5>
                        </div>
                        <div class="card-body p-5">
                            <form action="{{ route('organizer.events.update', $event) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <legend class="mb-4 text-center">Event Information</legend>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea name="description" id="description" class="form-control" required>{{ $event->description }}</textarea>
                                            </div>
                                            <div class="mb-4">
                                                <label for="start_date" class="form-label">Start Date and Time</label>
                                                <input type="datetime-local" name="start_date" id="start_date" class="form-control" value="{{ $event->start_date }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="end_date" class="form-label">End Date and Time</label>
                                                <input type="datetime-local" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="location" class="form-label">Location</label>
                                                <input type="text" name="location" id="location" class="form-control" value="{{ $event->location }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="category" class="form-label">Category</label>
                                                <select name="category" id="category" class="form-select" required>
                                                    @foreach(App\Enums\EventCategory::cases() as $category)
                                                        <option value="{{ $category->value }}" {{ $event->category->value === $category->value ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Map Section -->
                                            <div id="map" style="height: 300px; width: 100%;"></div>
                                            <input type="hidden" id="latitude" name="latitude" value="{{ $event->latitude }}">
                                            <input type="hidden" id="longitude" name="longitude" value="{{ $event->longitude }}">

                                            <div class="mb-4">
                                                <label for="available_tickets" class="form-label">Available Tickets</label>
                                                <input type="number" name="available_tickets" id="available_tickets" class="form-control" required min="1" value="{{ $event->available_tickets }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="photo1">Photo 1</label>
                                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="photo1" id="photo1" required>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="photo2">Photo 2</label>
                                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="photo2" id="photo2" required>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Update</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.organizer>

<!-- Include the Google Maps API script -->
<script src="https://maps.googleapis.com/maps/api/js?key=YourApiKey&callback=initMap" async defer></script>

<script>
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: { lat: {{ $event->latitude ?? 48.8566 }}, lng: {{ $event->longitude ?? 2.3522 }} } // Centre sur la position actuelle de l'événement ou par défaut (Paris)
    });

    map.addListener('click', function(event) {
      var lat = event.latLng.lat();
      var lng = event.latLng.lng();

      document.getElementById('latitude').value = lat;
      document.getElementById('longitude').value = lng;
    });
  }

  // Initialize the map after the page has loaded
  window.onload = initMap;
</script>

<style>
    .bg-gradient-primary {
        background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);
    }
    .card {
        border-radius: 15px;
    }
    .card-header {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    .form-control {
        border-radius: 10px;
    }
    .btn-lg {
        padding: 10px 20px;
        font-size: 1.25rem;
        border-radius: 10px;
    }
</style>
