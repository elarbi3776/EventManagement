<x-app-layout>


    <title>Google Maps Integration</title>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}"></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: {lat: 48.8566, lng: 2.3522} // Coordonées par défaut (Paris)
            });

            var events = @json($events);
            events.forEach(function(event) {
                var marker = new google.maps.Marker({
                    position: {lat: parseFloat(event.latitude), lng: parseFloat(event.longitude)},
                    map: map,
                    title: event.name
                });

                var infoWindow = new google.maps.InfoWindow({
                    content: `<h3>${event.name}</h3><p>${event.description}</p>`
                });

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });
    </script>

    <div id="map" style="height: 500px; width: 100%;"></div>
</x-app-layout>