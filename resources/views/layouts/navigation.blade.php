<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style type="text/css">
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
        }
        .custom-navbar {
            background: linear-gradient(90deg, rgba(0,123,255,1) 0%, rgba(40,167,69,1) 100%);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }
        .transparent-navbar {
            background: rgba(0, 123, 255, 0.5) !important; /* Ajustez l'opacité selon vos préférences */
            transition: background-color 0.3s;
        }
        .custom-navbar .navbar-brand {
            font-size: 22px;
            font-family: 'Courier New', Courier, monospace;
        }
        .custom-navbar .navbar-nav .nav-link {
            font-size: 16px;
            color: #fff !important;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }
        .custom-navbar .navbar-nav .nav-link:hover,
        .custom-navbar .navbar-nav .nav-link.active {
            background-color: rgba(255,255,255,0.2);
            border-radius: 5px;
            color: #fff !important;
        }
        .custom-navbar .navbar-toggler {
            border-color: rgba(255,255,255,0.3);
        }
        .custom-navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 0.5%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
        .custom-navbar .nav-item .fa-comments {
            font-size: 22px;
        }
        .custom-navbar .dropdown-toggle::after {
            display: none;
        }
        .custom-navbar .dropdown-menu {
            background-color: #343a40;
            border: none;
        }
        .custom-navbar .dropdown-menu .dropdown-item {
            color: #fff;
        }
        .custom-navbar .dropdown-menu .dropdown-item:hover {
            background-color: rgba(255,255,255,0.2);
        }
        .custom-navbar .dropdown-toggle {
            color: #fff !important;
        }
        .custom-navbar .dropdown-toggle .bi-person-circle {
            margin-left: 5px;
        }
        .custom-navbar .navbar-brand img {
            width: 30px;
            height: 30px;
        }
        .custom-navbar .dropdown-toggle .ml-2 {
            margin-left: 5px;
        }
        .custom-navbar .navbar-nav .nav-item.dropdown .dropdown-menu.position-selector {
            right: auto;
            left: 0;
            min-width: 200px;
        }
        .custom-navbar .navbar-nav .nav-item.dropdown .dropdown-menu.position-selector .dropdown-item {
            display: flex;
            align-items: center;
        }
        .custom-navbar .navbar-nav .nav-item.dropdown .dropdown-menu.position-selector .dropdown-item svg {
            margin-right: 10px;
        }
        .float-left {
            position: fixed;
            left: 10px;
            bottom: 10px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: background-color 0.3s;
        }
        .float-left:hover {
            background-color: #0056b3;
            color: white;
            text-decoration: none;
        }
        .float-button {
            position: fixed;
            right: 10px; /* Changer cette ligne de left: 10px; à right: 10px; */
            bottom: 10px;
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-radius: 50%;
            text-align: center;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, transform 0.3s;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .float-button:hover {
            background-color: #0056b3;
            transform: scale(1.1);
        }
        .float-button i {
            font-size: 24px;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top custom-navbar">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <x-application-logo class="w-7 h-7 fill-current text-gray-500" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <!-- Navigation Links -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('calendar.index') ? 'active' : '' }}" href="{{ route('calendar.index') }}">{{ __('Calendar') }}</a>
                    </li>
                    @role('Participant')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('participant.participant.events.show') ? 'active' : '' }}" href="{{ route('participant.participant.events.show') }}">{{ __('Events') }}</a>
                    </li>
                    @endrole
                    @role('Participant')
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('participant.comments') }}">{{ __('My Comments') }}</a>
                    </li>
                    @endrole
                    @role('Participant')
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('participant.reservations.index') }}">{{ __('My Reservations') }}</a>
                    </li>
                    @endrole
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('map') }}">{{ __('Map') }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- Inside the <ul class="navbar-nav ml-auto"> block -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell" style="color: white; position: relative;">
                                    <!-- Notification Count Badge -->
                                    @if(Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                                        <span class="badge badge-danger" style="position: absolute; top: -5px; right: -10px; font-size: 12px;">
                                            {{ Auth::user()->unreadNotifications->count() }}
                                        </span>
                                    @endif
                                </i>
                                <span class="ml-2">{{ __('Notifications') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
                                @if(Auth::check() && Auth::user()->unreadNotifications->count() > 0)
                                    @foreach(Auth::user()->unreadNotifications as $notification)
                                        <a class="dropdown-item" href="{{ route('participant.notifications.show', $notification->id) }}">
                                            <i class="fa fa-envelope"></i> {{ $notification->data['name'] }}
                                            <span class="text-muted small float-right">{{ $notification->created_at->diffForHumans() }}</span>
                                        </a>
                                    @endforeach
                                @else
                                    <span class="dropdown-item text-muted">{{ __('No new notifications') }}</span>
                                @endif
                            </div>
                        </li>

                        

                        @hasanyrole('Admin|Organizer')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="positionDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-briefcase" style="color: white;"></i>
                                <span class="ml-2">{{ __('Select Role') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right position-selector" aria-labelledby="positionDropdown">
                                @role('Admin')
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    <i class="fa fa-user-secret"></i>
                                    {{ __('Admin') }}
                                </a>
                                @endrole
                                @role('Organizer')
                                <a class="dropdown-item" href="{{ route('organizer.index') }}">
                                    <i class="fa fa-user-plus"></i>
                                    {{ __('Organizer') }}
                                </a>
                                @endrole
                            </div>
                        </li>
                        @endhasanyrole
                        <!-- Profile Icon and Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="ml-2">{{ Auth::user()->name }}</span>
                                <img src="{{ Auth::user()->avatar ? asset('storage/' . config('chatify.user_avatar.folder') . '/' . Auth::user()->avatar) : asset('storage/' . config('chatify.user_avatar.folder') . '/' . config('chatify.user_avatar.default')) }}" 
                                    alt="User Avatar" 
                                    class="rounded-circle ms-2" 
                                    style="width: 30px; height: 30px;">

                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    <!-- Page Content -->
    <main class="py-4 mt-5">
        <div class="container-fluid">
            {{ $slot }}
        </div>
    </main>

    <!-- Floating Button with Chat Icon Only -->
    <a href="/chatify" class="float-button">
        <i class="fas fa-comments"></i>
    </a>

    <script>
        $(document).ready(function() {
            var navbar = $('.custom-navbar');

            // Vérifie la position initiale du défilement
            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) { 
                    navbar.addClass('transparent-navbar');
                } else {
                    navbar.removeClass('transparent-navbar');
                }
            });
        });
    </script>
</body>
</html>
