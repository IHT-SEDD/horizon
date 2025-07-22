<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"">

<head>
<meta charset=" utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
<link rel="icon" href="{{ asset('assets/img/icons/horizon-icon.png') }}" type="image/x-icon">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('plugins/notyf/notyf.min.css') }}">
@yield('styles')

<!-- Scripts -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" data-theme="bumblebee">
    <div class="min-h-screen bg-base-200">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            @yield('main')
        </main>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/notyf/notyf.min.js') }}"></script>
    <script src="{{ asset('plugins/lucide.min.js') }}"></script>
    <script src="{{ asset('js/global/notyf-config.js') }}"></script>
    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>

</html>