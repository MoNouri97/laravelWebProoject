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
    <script src="{{ asset('js/theme.js') }}" defer></script>
    <script type="text/javascript" src="{{asset('js/followWriter.js')}} " defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/19a322160d.js" crossorigin="anonymous"></script>
    <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700|Roboto:300,400,700&display=swap" rel="stylesheet">


  <!-- Vendor CSS Files -->
  <link href="{{ asset('theme/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/vendor/line-awesome/css/line-awesome.min.css') }}" rel="stylesheet">
  

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('style')


</head>
<body>
<div id="app" class="site-wrap">
    @include('includes.nav')
    @hasSection ('hero')
        
    @else
        <div style="height: 100px"></div>
    @endif
{{-- @include('includes.newNav') --}}

<main id="main">
    @yield('hero')
    <div class="py-4 container-fluid">
        @yield('content-f')
        <div class="container" id="MainContainer">
            @include('includes.messages')
            @include('includes.breadcrumb')
            @yield('content')
        </div>
    </div>
</main>
</div>

</body>
</html>
