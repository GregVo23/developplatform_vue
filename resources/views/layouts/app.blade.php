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

        <!--Stripe-->
        <script src="https://js.stripe.com/v3/"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    </head>
    <body class="font-sans antialiased">


        <div class="min-h-screen bg-gray-200">
        <div class="bg-gray-200">

            <div id="app" message={{ Session::get('success') }}>
            </div>
            <div id="message" class="hidden" message={{ Session::get('success') }}>
            </div>
        </div>
        <footer id="footer" class="-mt-1.5">
            @include('partials.footer')
        </footer>
        </div>

        <!-- Specific Scripts -->
        @stack('scripts')
</body>
</html>
