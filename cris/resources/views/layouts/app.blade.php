<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/authenticated.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'C.R.I.S') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth('web')
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Crime</a>
                            <div class="dropdown-menu">
                                <a href="{{ route('crime.index') }}" class="dropdown-item">Reported Crimes</a>
                                <a href="{{ route('crime.create') }}" class="dropdown-item">Report</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Lost and Found</a>
                            <div class="dropdown-menu">
                                <a href="{{ route('items.allReported') }}" class="dropdown-item">All Reported</a>
                                <a href="{{ route('item.index') }}" class="dropdown-item">What I Reported Found</a>
                                <a href="{{ route('item.create') }}" class="dropdown-item">Report Found Item</a>
                            </div>
                        </li>
                    </ul>
                    @endauth
                    @auth('admin')
                    <ul class="class navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Officer</a>
                            <div class="dropdown-menu">
                                <a href="{{ route('police.create') }}" class="dropdown-item">Add New</a>
                                <a href="{{ route('police.index') }}" class="dropdown-item">All Officers</a>
                            </div>
                        </li>
                    </ul>
                    @endauth
                    @auth('officer')
                        <ul class="class navbar-nav">
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Crimes</a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('crimes.new') }}" class="dropdown-item">New Cases</a>
                                    <a href="{{ route('crime.myCases') }}" class="dropdown-item">My Active Cases</a>
                                    <a href="{{ route('crime.closed') }}" class="dropdown-item">Closed Cases</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Lost and Found</a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('all_reported') }}" class="dropdown-item">All Reported</a>
                                    <a href="{{ route('allNotCollected') }}" class="dropdown-item">Not Collected</a>
                                    <a href="{{ route('allCollected') }}" class="dropdown-item">Collected</a>
                                </div>
                            </li>
                        </ul>
                    @endauth
                    <!-- Left Side Of Navbar -->

                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @auth('admin')
                                    <a href="{{ route('admin.profile', Auth::guard('admin')->user()->id) }}" class="dropdown-item">Profile</a>
                                    @endauth
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form"
                                          action="@if(Auth::guard('admin')->check())
                                          {{ route('admin.logout') }}
                                          @elseif(Auth::guard('officer')->check())
                                          {{ route('police.logout') }}
                                          @else
                                          {{ route('logout') }}
                                          @endif"
                                          method="POST" class="d-none">
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
            @include('layouts.response_messages')
            @yield('content')
        </main>
    </div>
</body>
</html>
