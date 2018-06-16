<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '특별활동') }}</title>

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <link href="{{ asset('css/common.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/joy.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>

    @stack('styles')
</head>
<body>

    @yield('content')


    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/jquery.bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/js.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/scroll_minimize.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.11/handlebars.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/common.js?v=3') }}"></script>
    <script type="text/javascript" src="{{ asset('js/customer/Activity.js?v=12') }}"></script>
    <script type="text/javascript" src="{{ asset('js/customer/Place.js?v=1') }}"></script>
    @stack('scripts')
</body>
</html>
