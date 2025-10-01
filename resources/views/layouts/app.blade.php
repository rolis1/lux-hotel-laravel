<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Lux Hotel - Receptionist' }}</title>

    <link rel="icon" href="{{ asset('images/logo.png')}}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        /* Custom Styles for Receptionist Dashboard */
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Nunito', sans-serif;
        }

        #app {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-bottom: none;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .navbar-brand::before {
            content: '🏨';
            margin-right: 10px;
            font-size: 1.3rem;
        }

        .navbar-toggler {
            border: 1px solid rgba(255,255,255,0.3);
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            align-items: center;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-link:hover {
            color: white !important;
            background: rgba(255,255,255,0.1);
            transform: translateY(-1px);
        }

        .nav-link:hover::before {
            width: 80%;
        }

        .nav-link i {
            margin-right: 8px;
            font-size: 0.9rem;
            width: 16px;
            text-align: center;
        }

        /* Dropdown Styles */
        .navbar-nav .dropdown-menu {
            background: white;
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            margin-top: 10px;
            padding: 10px 0;
        }

        .dropdown-toggle {
            background: rgba(255,255,255,0.1) !important;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            padding: 0.5rem 1rem !important;
        }

        .dropdown-toggle::after {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .dropdown-toggle.show::after {
            transform: rotate(180deg);
        }

        .dropdown-item {
            padding: 10px 20px;
            color: #2c3e50;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: translateX(5px);
        }

        .dropdown-item i {
            margin-right: 8px;
            width: 16px;
            text-align: center;
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 2rem 0;
        }

        .container {
            max-width: 1200px;
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .alert::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: currentColor;
            opacity: 0.7;
        }

        .alert-success {
            background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
            color: white;
        }

        .alert-warning {
            background: linear-gradient(135deg, #ffd43b 0%, #fcc419 100%);
            color: #2c3e50;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
            color: white;
        }

        .alert-info {
            background: linear-gradient(135deg, #339af0 0%, #228be6 100%);
            color: white;
        }

        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: none;
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-bottom: none;
            padding: 1.5rem 2rem;
            color: white;
        }

        .card-header h1, .card-header h2, .card-header h3, .card-header h4, .card-header h5, .card-header h6 {
            color: white;
            margin: 0;
            font-weight: 700;
        }

        .card-body {
            padding: 2rem;
        }

        /* Table Styles */
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .table thead th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 2px solid #667eea;
            color: #2c3e50;
            font-weight: 700;
            padding: 1rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f8f9ff;
            transform: translateX(5px);
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.5rem 1.5rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffd43b 0%, #fcc419 100%);
            color: #2c3e50;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff6b6b 0%, #fa5252 100%);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.2rem;
                padding: 0.4rem 0.8rem;
            }

            .nav-link {
                padding: 0.8rem 1rem !important;
                margin: 0.1rem 0;
                text-align: center;
            }

            .nav-link::before {
                display: none;
            }

            .dropdown-menu {
                border-radius: 8px;
                margin-top: 5px;
            }

            .card-body {
                padding: 1.5rem;
            }

            main {
                padding: 1rem 0;
            }
        }

        /* Animation for navbar items */
        .navbar-nav .nav-item {
            animation: slideInDown 0.5s ease forwards;
            opacity: 0;
            transform: translateY(-10px);
        }

        .navbar-nav .nav-item:nth-child(1) { animation-delay: 0.1s; }
        .navbar-nav .nav-item:nth-child(2) { animation-delay: 0.2s; }
        .navbar-nav .nav-item:nth-child(3) { animation-delay: 0.3s; }
        .navbar-nav .nav-item:nth-child(4) { animation-delay: 0.4s; }
        .navbar-nav .nav-item:nth-child(5) { animation-delay: 0.5s; }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a6fd8 0%, #6a42a8 100%);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('#home') }}">
                    Lux Hotel
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt"></i>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fas fa-user-plus"></i>{{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            @if (Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('roomtype.index') }}">
                                        <i class="fas fa-tags"></i>{{ __('Tipe Kamar') }}
                                    </a>
                                </li>
                            @elseif(Auth::user()->role == 'resepsionis')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('receptionis.logs') }}">
                                        <i class="fas fa-history"></i>{{ __('Logs') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('receptionis.checkin') }}">
                                        <i class="fas fa-check-circle"></i>{{ __('Check In') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('receptionis.reservations') }}">
                                        <i class="fas fa-calendar-check"></i>{{ __('Reservations') }}
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="#kamar">
                                        <i class="fas fa-bed"></i>{{ __('Kamar') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#fasilitas">
                                        <i class="fas fa-concierge-bell"></i>{{ __('Fasilitas') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#tentang">
                                        <i class="fas fa-info-circle"></i>{{ __('Tentang') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#kontak">
                                        <i class="fas fa-phone"></i>{{ __('Kontak') }}
                                    </a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user-circle"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('script')
    <script>
        setTimeout(function() {
            $('.alert').fadeOut('fast');
        }, 3000); // <-- time in milliseconds

        // Add smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>