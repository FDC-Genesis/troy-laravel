<!DOCTYPE html>
<html lang="en" ng-app="myApp">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ? $title : 'Document' }}</title>
    
        <!-- Bootstrap 5 CSS -->
        <link href="{{ asset('libs/css/bootstrap-5.3.3.css') }}" rel="stylesheet">
    
        <!-- DataTables CSS -->
        <link href="{{ asset('libs/css/datatables-1.13.css') }}" rel="stylesheet">
    
        <!-- jQuery -->
        <script src="{{ asset('libs/js/jquery-3.7.1.js') }}"></script>
    
        <!-- Bootstrap 5 JS Bundle -->
        <script src="{{ asset('libs/js/bootstrap-5.3.3.js') }}"></script>
    
        <!-- DataTables JS -->
        <script src="{{ asset('libs/js/datatables-1.13.js') }}"></script>
    </head>
    
    <body>
        {{ $slot }}
    </body>
</html>