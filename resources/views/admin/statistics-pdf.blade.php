<!DOCTYPE html>
<html>
<head>
    <title>Global Statistics Report</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            width: 85%;
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            font-family: 'Montserrat', sans-serif;
        }

        .header {
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            text-transform: uppercase;
            border-bottom: 4px solid #3498db;
            padding-bottom: 10px;
            letter-spacing: 1px;
        }

        .introduction {
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
            color: #555;
        }

        .section {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 8px;
            background: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .section h5 {
            font-size: 22px;
            margin-bottom: 20px;
            color: #3498db;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            text-transform: uppercase;
        }

        .section p, .section ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .section p span, .section ul li span {
            font-weight: 700;
            color: #e74c3c;
        }

        .section ul {
            padding-left: 20px;
        }

        .section ul li {
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .section ul li:hover {
            background-color: #ecf0f1;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #7f8c8d;
            font-size: 14px;
        }

        .chart-container {
            margin: 20px 0;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .chart-container h5 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">Global Statistics Report</div>

        <div class="introduction">
            <p>
                Welcome to the Global Statistics Report. This comprehensive report provides an overview of the key metrics and trends related to user activity, event management, and reservations within our system. 
                By analyzing these statistics, we can gain valuable insights into user behavior, track the performance of our events, and identify opportunities for growth and improvement.
                In this report, you will find detailed information on user distribution by role, event statistics, reservation trends, and recent activities. The data presented aims to give you a clear understanding of the current state of our operations and help you make informed decisions based on the latest insights.
            </p>
        </div>

        <div class="section">
            <h5>Users</h5>
            <p>Total users: <span>{{ $totalUsers }}</span></p>
        </div>

        <div class="section">
            <h5>Distribution of Users by Role</h5>
            <ul>
                <li>Admins : <span>{{ $adminsCount }}</span></li>
                <li>Organizers : <span>{{ $organizersCount }}</span></li>
                <li>Participants : <span>{{ $participantsCount }}</span></li>
            </ul>
        </div>

        <div class="section">
            <h5>Events</h5>
            <p>Total events: <span>{{ $totalEvents }}</span></p>
        </div>

        <div class="section">
            <h5>Distribution of Events by Category</h5>
            <ul>
                @foreach($eventCategories as $category => $count)
                    <li>{{ $category }} : <span>{{ $count }}</span></li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h5>Reservations</h5>
            <p>Total reservations: <span>{{ $totalReservations }}</span></p>
        </div>

        <div class="section">
            <h5>Recent Events</h5>
            <ul>
                @foreach($recentEvents as $event)
                    <li>{{ $event->name }} ({{ $event->start_date->format('d M Y') }})</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h5>Bookings by Event</h5>
            <ul>
                @foreach($eventsWithReservations as $event)
                    <li>{{ $event->name }} : <span>{{ $event->reservations_count }}</span> reservations</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h5>Monthly Registrations</h5>
            <ul>
                @foreach($monthlyRegistrations as $month => $count)
                    <li>{{ date('F', mktime(0, 0, 0, $month, 1)) }} : <span>{{ $count }}</span> registrations</li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h5>New Users</h5>
            <p>New users today: <span>{{ $newUsersThisDay }}</span></p>
            <p>New users this month: <span>{{ $newUsersThisMonth }}</span></p>
            <p>Total registrations this year: <span>{{ $registrationsThisYear }}</span></p>
        </div>

        <div class="section">
            <h5>New Users per Day (Current week)</h5>
            <ul>
                @foreach($weekDays as $index => $day)
                    <li>{{ $day }} : <span>{{ $newUsersWeekly[$index] }}</span></li>
                @endforeach
            </ul>
        </div>

       

        <div class="footer">
            Report generated on {{ date('d M Y') }}
        </div>
    </div>
</body>
</html>
