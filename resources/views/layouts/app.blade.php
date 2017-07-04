<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cloud Binary Invest') }} - @yield('title', '')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @if(Auth::check() && Auth::user()->checkIfAdmin())
                      <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                          {{ config('app.name', 'Laravel') }}
                      </a>
                    @elseif(Auth::check())
                    <a class="navbar-brand" href="{{ route('dashboard') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    @else
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    @endif
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    @if(Auth::check() && Auth::user()->checkIfAdmin())
                    <ul class="nav navbar-nav navbar-left">
                      <li><a href=""> (Admin panel, manage Cloud Binary Invest.) </a></li>
                    </ul>
                    @else
                    <ul class="nav navbar-nav navbar-left">
                      <li><a href="{{ route('works') }}"> How it works </a></li>
                      <li><a href="{{ route('faqs') }}"> FAQs </a></li>
                      <li><a href="{{ route('rules') }}"> Rules </a></li>
                      <li><a href="{{ route('plans.view-all') }}"> Plans </a></li>
                      <li><a href="{{ route('support.new') }}">Support</a></li>
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}"> <i class="fa fa-sign-in"></i> Login</a></li>
                            <li><a href="{{ route('register') }}"> <i class="fa fa-plus"></i> Register</a></li>
                        @else
                            <li class="logged-in"> <a href=""><i class="fa fa-user-circle-o"></i> {{ Auth::user()->name }}</a>  </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
          <div class="row">

            <div class="col-lg-3 col-lg-offset-1 col-md-3 col-sm-12">
                @include('partials.sidebar')
            </div>

            <div class="col-lg-7 col-md-9 col-sm-12">

              <div class="alerts">
                 <!-- Showing alert messages -->
                  @include('layouts.alert')
              </div>

              @yield('content')
            </div>


          </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    @include('partials.footer')

</body>
</html>
