<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Developplatform') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!--AlpineJs-->
        <style>[x-cloak] { display: none; }</style>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    </head>
    <body class="font-sans antialiased">


        <div class="min-h-screen bg-gray-200">
        <header class="pb-4 bg-gray-200">
            <div id="app">

            </div>
        </header>
        <main class="mt-4 mb-4">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-full lg:px-8">
            <h1 class="sr-only">Page title</h1>

                <!-- Content -->
                {{ $slot }}

            </div>
        </main>
        <footer id="footer">
            @include('partials.footer')
        </footer>
        </div>

        <!-- Specific Scripts -->
        @stack('scripts')
</body>
</html>
