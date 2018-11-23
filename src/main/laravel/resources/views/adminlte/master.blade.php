<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" style="height: auto;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>

        {{-- Tell the browser to be responsive to screen width --}}
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        {{-- Application favicon --}}
        <link rel="icon" type="image/x-icon" class="js-site-favicon" href="{{ asset('images/favicon.ico') }}">

        {{-- Main Application style --}}
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        @yield('adminlte_css')
    </head>

    <body class="hold-transition @yield('body_class')">
        @yield('body')

        {{-- Main Application script --}}
        <script src="{{ asset('js/main.js') }}"></script>

        @yield('adminlte_js')
    </body>
</html>
