{{-- <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    @include('layouts.header')
    @include('layouts.app')
</head>
<body>
    @yield('body')
    @include('layouts.header')
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
</body>
</html> --}}
<!doctype html>
 <html lang="en">
 <head>
 <meta charset="UTF-8">
 <title></title>
 @include('layouts.app')
 @include('layouts.header')
 </head>
 <body>
    @yield('body')
{{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
 </body>
 </html>