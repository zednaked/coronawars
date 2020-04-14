<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        a .card {
            color: black !important;
        }
        @keyframes blinker {
          50% {
            opacity: 0;
          }
        }
    </style>
	@yield('head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('request-masks') }}">
                                {{ __('Request masks') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://vaka.me/952315" target="_blank">
                                {{ __('Contribute') }}
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{route('show-statistics')}}" >
                                {{ __('Show statistics') }}
                            </a>
                        </li>
                @if(Auth::check())
                @if( Auth::user()->hasRole('superadministrator') || Auth::user()->hasRole('deliverer') )
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('list-seamstresses')}}">
                                        {{ __('List seamstresses')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('list-supply-request')}}">
                                        {{ __('List supply requests')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('list-requests') }}">
                                {{ __('List requests') }}
                            </a>
                        </li>
                @endif
                @endif
                    </ul>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    @if( Auth::user()->roles()->exists() )
                                    <a class="dropdown-item" href="{{ route('list-users') }}">
                                        {{ __('Manage users') }}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{route('list-seamstresses')}}">1. 
                                        {{ __('List seamstresses')}}
                                    </a>
                                    <a class="dropdown-item" href="{{route('list-supply-request')}}">2. 
                                        {{ __('List supply requests')}}
                                    </a>
                                    <a class="dropdown-item" href="{{route('list-requests')}}">3. 
                                        {{ __('List requests or assign work')}}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="https://youtu.be/9WaS6nzdQhU" target="_blank">
                                        {{ __('Help - How to use')}}
                                    </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{env('GOOGLE_ANALYTICS')}}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '{{env('GOOGLE_ANALYTICS')}}');
</script>

</body>
</html>
