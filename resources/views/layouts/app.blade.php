<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('layouts.header')

    <div class="container">
        @yield('content')
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
@yield('scripts')
</body>
</html>
