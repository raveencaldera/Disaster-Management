<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ministry of Disaster Management</title>

    <!-- Styles -->
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div id="wrapper">
        @include('layouts.navbar')
        <div class="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div> <!-- /.container-fluid -->
        </div> <!-- /#page-wrapper -->
    </div>
</div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
