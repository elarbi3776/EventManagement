<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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
<body>
    <!-- =========================
         PRE LOADER       
    ============================== -->
    <div class="preloader">
        <div class="sk-rotating-plane"></div>
    </div>

    <!-- Navigation Links -->
    <div class="font-sans antialiased">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top custom-navbar">
            <div class="container-fluid">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="navbar-brand" style="display: flex; align-items: center;">
                    <x-application-logo class="w-7 h-7 fill-current text-gray-500" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about')}}">{{ __('About Us') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">{{ __('Contact Us') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <script>
        window.addEventListener('scroll', function() {
            var navbar = document.querySelector('.custom-navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('transparent-navbar');
            } else {
                navbar.classList.remove('transparent-navbar');
            }
        });
    </script>
</body>
</html>
