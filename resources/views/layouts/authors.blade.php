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
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1 class="h1 text-primary">
                    {{ config('app.name', 'Laravel') }}

                    </h1>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">Articles</a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link">Home</a>
                        </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            <div class="container">
                <div class="container-fluid">
                    <div class="row">
                      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
                        <div class="position-sticky pt-3">
                          <ul class="nav flex-column">
                            <li class="nav-item text-white">
                                <h4>Dashboard</h4>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link text-white" href="{{ url('/home') }}">
                                <span><i class="bi bi-card-checklist"></i></span>
                                Articles
                              </a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link text-white" href="{{ url('/articles/new') }}">
                                <span><i class="bi bi-file-earmark-plus"></i></span>
                                Create Articles
                              </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/author/profile') }}">
                                  <span><i class="bi bi-person-circle"></i></span>
                                  Profile
                                </a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link text-white" href="{{ url('/info') }}">
                                  <span><i class="bi bi-info-circle"></i></span>
                                  About
                                </a>
                              </li>
                          </ul>
                        </div>
                      </nav>
                  
                      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 bg-white">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                          <h1 class="h2">@yield('title-page')</h1>
                        </div>
                        @yield('content')
                        </div>
                      </main>
                    </div>
                  </div>
            </div>
        </main>
    </div>

    @section('script')
        
    @show
</body>
</html>
