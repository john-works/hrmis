<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Recruitment') }}</title>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
     --}}

       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    
    <!-- Styles via Vite -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body>



    <div id="app">
           <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color: #053f6b;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbarCollapse">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item" id="homeNavItem"><a class="nav-link" href="#" onclick="showHomePage()">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('selectJob')">Jobs</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" onclick="showProfileSection()">My Profile</a></li>
                        </script>
                        <script>
                        // Show Personal Details and always fetch user data
                        function showProfileSection() {
                            showSection('personalDetails');
                            // Wait for the section to be visible, then fetch and populate
                            setTimeout(function() {
                                // Use the same API logic as in your main JS
                                const apiUrl = 'http://192.168.32.215:8041/api/v1';
                                let user = null;
                                try { user = JSON.parse(localStorage.getItem('user')); } catch {}
                                const userId = user && user.id ? user.id : 1;
                                const url = `${apiUrl}/applicants/${userId}`;
                                const token = localStorage.getItem('token');
                                fetch(url, { headers: token ? { 'Authorization': `Bearer ${token}` } : {} })
                                    .then(res => res.json())
                                    .then(data => {
                                        if (data && typeof data === 'object') {
                                            document.getElementById('firstName').value = data.first_name || '';
                                            document.getElementById('middleName').value = data.middle_name || '';
                                            document.getElementById('lastName').value = data.last_name || '';
                                            document.getElementById('emailDetail').value = data.email || '';
                                            document.getElementById('contact').value = data.contact || '';
                                            document.getElementById('ninDetail').value = data.nin || '';
                                            document.getElementById('genderDetail').value = data.gender || '';
                                            document.getElementById('dobDetail').value = data.date_of_birth || '';
                                            document.getElementById('statusDetail').value = data.marital_status || '';
                                        }
                                    });
                            }, 300);
                        }
                        </script>
                        <li class="nav-link" href="#" onclick="showSection('myApplication')">My Applications</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('documents')">Documents</a></li> -->
                    </div>
                </ul>
            </div>

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
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
            @yield('content')
        </main>
    </div>
@include('layouts.footer')
