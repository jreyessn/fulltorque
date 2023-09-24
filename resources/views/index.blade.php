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

        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

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
        <!-- Required datatable js -->
        <script src="{{ asset("assets/plugins/datatables/jquery.dataTables.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/dataTables.bootstrap4.min.js") }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset("assets/plugins/datatables/dataTables.buttons.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/buttons.bootstrap4.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/jszip.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/pdfmake.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/vfs_fonts.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/buttons.html5.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/buttons.print.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/buttons.colVis.min.js") }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset("assets/plugins/datatables/dataTables.responsive.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/datatables/responsive.bootstrap4.min.js") }}"></script>
        <script src="{{ asset("assets/plugins/sweet-alert2/sweetalert2.min.js") }}"></script>
        
    </body>
</html>
