<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

    <head>
    <meta charset="utf-8" />
    <title>@yield('title') | Agence Bassin Hydraulique - Draa Oued Noun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Agence Bassin Hydraulique - Draa Oued Noun" name="description" />
    <meta content="Achraf Moreau" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/logo-sm.png')}}">
        @include('layouts.head-css')
  </head>

    @yield('body')

    @yield('content')

    @include('layouts.vendor-scripts')
    </body>
</html>
