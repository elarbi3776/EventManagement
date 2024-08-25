<x-app-layout>
    <section class="calendar-section">
        <title>Calendar</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- FullCalendar CSS -->
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js'></script>

        <style>
            .calendar-section {
                font-family: 'Arial', sans-serif;
                background-color: #f8f9fa;
            }
            .calendar-container {
                margin-top: 1px;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease-in-out;
            }
            .calendar-container:hover {
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }
            .fc-toolbar-title {
                font-size: 24px;
                font-weight: bold;
                color: #007bff;
            }
            .fc-button {
                background-color: #007bff !important;
                border: none !important;
                color: white !important;
                padding: 5px 10px;
                border-radius: 3px;
                transition: background-color 0.3s ease-in-out;
            }
            .fc-button:hover {
                background-color: #0056b3 !important;
            }
            .fc-button:focus {
                box-shadow: none !important;
            }
            .fc-daygrid-event {
                background-color: #007bff !important;
                border: none !important;
                color: white !important;
                padding: 5px;
                border-radius: 3px;
                font-size: 12px;
                transition: background-color 0.3s ease-in-out;
            }
            .fc-daygrid-event:hover {
                background-color: #0056b3 !important;
            }
            .fc-daygrid-day-number {
                color: #007bff;
                font-weight: bold;
            }
            .fc-header-toolbar {
                margin-bottom: 20px;
            }
            .fc-col-header-cell-cushion {
                color: #007bff;
                font-weight: bold;
                font-size: 14px;
            }
            #calendar {
                height: 80vh;
                width: 100%;
                margin: 0 auto;
            }
            .filter-container {
                margin-bottom: 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                background-color: #007bff;
                border-radius: 8px;
                color: white;
            }
            .filter-container label {
                margin-right: 10px;
                font-weight: bold;
            }
            .filter-container input[type="date"] {
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 5px;
                margin-right: 10px;
                transition: border-color 0.3s ease-in-out;
            }
            .filter-container input[type="date"]:focus {
                border-color: #0056b3;
                outline: none;
            }
            .filter-container button {
                background-color: white;
                color: #007bff;
                border: 1px solid #007bff;
                border-radius: 4px;
                padding: 5px 10px;
                transition: all 0.3s ease-in-out;
            }
            .filter-container button:hover {
                background-color: #0056b3;
                color: white;
                border-color: #0056b3;
            }
        </style>

        <div class="calendar-container">
            <div class="filter-container">
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" class="form-control">
                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" class="form-control">
                <button id="filter-btn" class="btn btn-light">Filter</button>
                <button id="my-reservations-btn" class="btn btn-light">My Reservations</button>
            </div>
            <div id="calendar"></div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: function(fetchInfo, successCallback, failureCallback) {
                        var startDate = document.getElementById('start-date').value;
                        var endDate = document.getElementById('end-date').value;

                        var url = '/calendar/events';
                        if (startDate && endDate) {
                            url += `?start_date=${startDate}&end_date=${endDate}`;
                        }

                        fetch(url)
                            .then(response => response.json())
                            .then(data => successCallback(data))
                            .catch(error => failureCallback(error));
                    }
                });

                calendar.render();

                document.getElementById('filter-btn').addEventListener('click', function () {
                    calendar.refetchEvents();
                });

                document.getElementById('my-reservations-btn').addEventListener('click', function () {
                    var startDate = document.getElementById('start-date').value;
                    var endDate = document.getElementById('end-date').value;

                    var url = '/calendar/events?user_reservations=1';
                    if (startDate && endDate) {
                        url += `&start_date=${startDate}&end_date=${endDate}`;
                    }

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            calendar.removeAllEvents();
                            calendar.addEventSource(data);
                        })
                        .catch(error => console.error('Error fetching events:', error));
                });
            });
        </script>
    </section>
</x-app-layout>
