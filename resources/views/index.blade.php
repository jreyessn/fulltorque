<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>{{ env('APP_NAME') }}</title>
        <script src="{{ asset('js/app.js') }}?{{ rand() }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/metismenu.min.css') }}?{{ rand() }}" rel="stylesheet">
        <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}?{{ rand() }}" rel="stylesheet">
    </head>
    <body>
        <div id="page" class="d-flex flex-column">
            <div id="app">@yield('content')</div>
        </div>

    <script src="{{asset ("assets/js/jquery.min.js")}}"></script>
    <script src="{{asset ("assets/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset ("assets/js/metismenu.min.js")}}"></script>
    <script src="{{asset ("assets/js/jquery.slimscroll.js")}}"></script>

    <script src="{{asset ("assets/js/waves.min.js")}}"></script>
     <script src="{{asset ("assets/js/app.js")}}?{{ rand() }}"></script>
    </body>
</html>
