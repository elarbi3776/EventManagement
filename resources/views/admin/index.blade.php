<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight bg-indigo-600 p-4 rounded-lg">
            {{ __('Dashboard Administrateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-4">
                        <h1 class="mb-4">Admin Dashboard</h1>
                    
                        <div class="row">
                            <!-- Card for Roles utilisateurs -->
                            <div class="col-md-3">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">User roles</h5>
                                        <p class="card-text">Manage your roles here.</p>
                                        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">See all roles</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card for Créer une Permission -->
                            <div class="col-md-3">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Create a Permission</h5>
                                        <p class="card-text">Manage permissions here.</p>
                                        <a href="{{ route('admin.permissions.index') }}" class="btn btn-success">See all permissions.</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card for Utilisateurs -->
                            <div class="col-md-3">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Users</h5>
                                        <p class="card-text">Manage users here.</p>
                                        <a href="{{ route('admin.users.index') }}" class="btn btn-success">See all users.</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card for Commentaires Récents -->
                            <div class="col-md-3">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Recent Comments</h5>
                                        <p class="card-text">Read and manage participant comments.</p>
                                        <a href="{{ route('admin.comments.index') }}" class="btn btn-warning">See comments</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h1 class="text-3xl font-bold mb-5 text-indigo-700">Global Statistics</h1>
            
            <!-- Bouton de téléchargement du PDF -->
            <a href="{{ route('admin.downloadPdf') }}" class="btn btn-primary mb-4">Download PDF Report</a>
            <a href="{{ route('admin.download.excel') }}" class="btn btn-primary mb-4">Download Excel Report</a>

            <div class="row">
                <!-- Répartition des utilisateurs par rôle -->
                <div class="col-md-4">
                    <h5 class="mb-3">Distribution of Users</h5>
                    <canvas id="userRoleChart"></canvas>
                </div>

                <!-- Répartition des événements par catégorie -->
                <div class="col-md-4">
                    <h5 class="mb-3">Distribution of Events by Category</h5>
                    <canvas id="eventCategoryChart"></canvas>
                </div>

                <!-- Réservations par Événement -->
                <div class="col-md-4">
                    <h5 class="mb-3">Bookings by Event</h5>
                    <canvas id="eventReservationsChart"></canvas>
                </div>
            </div>

            <div class="row mt-5">
                <!-- Évolution des Inscriptions -->
                <div class="col-md-6">
                    <h5 class="mb-3">Evolution of Registrations (Monthly)</h5>
                    <canvas id="userRegistrationsChart"></canvas>
                </div>

                <!-- Nouveaux utilisateurs par jour (Semaine en cours) -->
                <div class="col-md-6">
                    <h5 class="mb-3">New Users (Current Week)</h5>
                    <canvas id="newUsersWeeklyChart"></canvas>
                </div>
            </div>
            <div class="row mt-5">
                <!-- Évaluations moyennes par événement -->
                <div class="col-md-6">
                    <h5 class="mb-3">Average Ratings by Event</h5>
                    <canvas id="averageRatingsChart"></canvas>
                </div>
            </div>
            
        </div>
    </div>
    

    
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script>
                // Évaluations moyennes par événement
            var averageRatingsChartCtx = document.getElementById('averageRatingsChart').getContext('2d');
            var averageRatingsChart = new Chart(averageRatingsChartCtx, {
                type: 'bar',
                data: {
                    labels: @json($averageRatings->keys()),
                    datasets: [{
                        label: 'Average Rating',
                        data: @json($averageRatings->values()),
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5 // Assuming the rating scale is 1 to 5
                        }
                    }
                }
            });

   </script>
   
    <script>
        // Répartition des utilisateurs par rôle
        var userRoleChartCtx = document.getElementById('userRoleChart').getContext('2d');
        var userRoleChart = new Chart(userRoleChartCtx, {
            type: 'doughnut',
            data: {
                labels: ['Admin', 'Organisateur', 'Participant'],
                datasets: [{
                    data: [{{ $adminsCount }}, {{ $organizersCount }}, {{ $participantsCount }}],
                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(75, 192, 192, 0.6)']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Répartition des événements par catégorie
        var eventCategoryChartCtx = document.getElementById('eventCategoryChart').getContext('2d');
        var eventCategoryChart = new Chart(eventCategoryChartCtx, {
            type: 'doughnut',
            data: {
                labels: @json($eventCategories->keys()),
                datasets: [{
                    data: @json($eventCategories->values()),
                    backgroundColor: ['rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)', 'rgba(255, 205, 86, 0.6)']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Réservations par Événement
        var eventReservationsChartCtx = document.getElementById('eventReservationsChart').getContext('2d');
        var eventReservationsChart = new Chart(eventReservationsChartCtx, {
            type: 'bar',
            data: {
                labels: @json($eventNames),
                datasets: [{
                    label: 'Réservations',
                    data: @json($reservationsCount),
                    backgroundColor: 'rgba(255, 205, 86, 0.6)',
                }, {
                    label: 'Capacité',
                    data: @json($eventCapacities),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Évolution des Inscriptions (Mensuel)
        var userRegistrationsChartCtx = document.getElementById('userRegistrationsChart').getContext('2d');
        var userRegistrationsChart = new Chart(userRegistrationsChartCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Inscriptions',
                    data: @json($monthlyRegistrations),
                    borderColor: 'rgba(75, 192, 192, 0.6)',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Nouveaux utilisateurs par jour (Semaine en cours)
        var newUsersWeeklyChartCtx = document.getElementById('newUsersWeeklyChart').getContext('2d');
        var newUsersWeeklyChart = new Chart(newUsersWeeklyChartCtx, {
            type: 'bar',
            data: {
                labels: @json($weekDays),
                datasets: [{
                    label: 'Nouveaux Utilisateurs',
                    data: @json($newUsersWeekly),
                    backgroundColor: 'rgba(255, 159, 64, 0.6)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-admin-layout>
