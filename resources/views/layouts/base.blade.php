<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>

    <!-- CSS Global -->
    @vite([
        'resources/css/app.css',
        'resources/css/bootstrap-overrides.css',
        'resources/css/selectize-overrides.css',
    ])

    @yield('styles')
    @stack('styles')
</head>
<body>
    <!-- Main Layout -->
    @yield('content')

    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer">
        <!-- Toasts will be added here -->
    </div>

    @vite([
        'resources/js/app.js'
    ])

    <script>
        window.sessionMessage = @json(session('message'));
        window.website_settings = @json(config('settings'));
    </script>

    @yield('scripts')
    @stack('scripts')
    
    @yield('modals')
</body>
</html>