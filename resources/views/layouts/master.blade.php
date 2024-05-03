<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/.../css/bootstrap.min.css" >
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        {{-- <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet"> --}}
        <link rel="stylesheet" href="{{ url('src/css/app.css')}}">
        @yield('styles')
    </head>
    <body>
        @include('partials._header')
        <div class="container">
            @yield('content')
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/.../Chart.js/2.9.3/Chart.min.js"></script>
        {{-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> --}}
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        {{-- <script src="https://maxcdn.bootstrapcdn.com/.../js/bootstrap.min.js" ></script> --}}
        @yield('scripts')
    </body>
</html>