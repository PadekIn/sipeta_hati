<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sipeta Hati') }}</title>
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />
</head>

<body>
    <div class="layer"></div>
    <main class="page-center">
        {{ $slot }}
    </main>
    <!-- Chart library -->
    <script src="{{ asset('assets/plugins/chart.min.js') }}"></script>
    <!-- Icons library -->
    <script src="{{ asset('assets/plugins/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
