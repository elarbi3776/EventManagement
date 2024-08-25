<x-layouts.organizer>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-4">
                        <h1 class="mb-4">Organizer Dashboard</h1>
                    
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Recent Events</h5>
                                        <p class="card-text">Manage your latest events here.</p>
                                        <a href="{{ route('organizer.events.index') }}" class="btn btn-primary">See all events</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Create an Event</h5>
                                        <p class="card-text">Start a new event now.</p>
                                        <a href="{{ route('organizer.events.create') }}" class="btn btn-success">Create an event</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Recent Comments</h5>
                                        <p class="card-text">Read and manage participant comments.</p>
                                        <a href="{{ route('organizer.comments.org') }}" class="btn btn-warning">See comments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <h2 class="mb-4">Event Statistics</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <!-- Insérer ici un graphique des inscriptions -->
                                <canvas id="eventRegistrationsChart"></canvas>
                            </div>
                            <div class="col-md-6">
                                <!-- Insérer ici un graphique des participations -->
                                <canvas id="eventAttendanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                    
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                        // Récupérer les données des réservations mensuelles
                        var monthlyReservations = @json(array_values($monthlyReservations));
                        var months = @json(array_keys($monthlyReservations));
                        
                        // Configuration du graphique des réservations
                        var ctx = document.getElementById('eventRegistrationsChart').getContext('2d');
                        var eventRegistrationsChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: months,
                                datasets: [{
                                    label: 'Réservations',
                                    data: monthlyReservations,
                                    borderColor: 'rgba(0,123,255,1)',
                                    fill: false
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true, // Commence l'axe Y à zéro
                                        title: {
                                            display: true,
                                            text: 'Nombre de Réservations'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Mois'
                                        }
                                    }
                                }
                            }
                        });
                    
                        // Récupérer les données des participations par événement
                        var eventAttendance = @json(array_values($eventAttendance));
                        var events = @json(array_keys($eventAttendance));
                        
                        // Configuration du graphique des participations
                        var ctx2 = document.getElementById('eventAttendanceChart').getContext('2d');
                        var eventAttendanceChart = new Chart(ctx2, {
                            type: 'bar',
                            data: {
                                labels: events,
                                datasets: [{
                                    label: 'Participation',
                                    data: eventAttendance,
                                    backgroundColor: 'rgba(40,167,69,1)'
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true, // Commence l'axe Y à zéro
                                        title: {
                                            display: true,
                                            text: 'Nombre de Participants'
                                        }
                                    },
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Événements'
                                        }
                                    }
                                }
                            }
                        });
                    </script>
                    
                    

                </div>
            </div>
        </div>
    </div>
</x-layouts.organizer>
