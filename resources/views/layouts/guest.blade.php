<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('assets/img/icons/horizon-icon.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased" data-theme="bumblebee">
    <div class="min-h-screen md:bg-base-200/50 bg-base-100 flex items-center justify-center">
        <div class="w-full md:max-w-xl">
            <div class="card bg-base-100 w-full md:shadow-lg">
                <div class="card-body">
                    <div class="flex flex-col justify-center items-center p-2 space-y-9">
                        <div class="flex items-center justify-center w-full">
                            <img src="{{ asset('assets/img/logos/horizon.png') }}" alt="horizon logo"
                                style="width:25%; height:25%;">
                        </div>
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
        {{-- @yield('main') --}}
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>