<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('description') - Ação Comunicativa">
        <title> @yield('title') {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/css/sharetastic.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @yield('styles')
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="content w-full h-screen flex justify-center items-center">
            <div class="font-bold text-4xl text-center">
                <div class="px-6">
                    <img src="/logo-acao-comunicativa.png" class="w-96 mx-auto" alt="">
                </div>
                <div>
                    <img src="/img/maintenance.svg" alt="">
                </div>
                <div>
                    Em construção
                </div>
            </div>

        </div>
        @livewireScripts
        @yield('scripts')
    </body>
</html>
