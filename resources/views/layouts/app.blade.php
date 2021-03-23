<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
            body::after {
                content:'Photo à Bordeaux';
                position: absolute;
                top: 0;
                left: 0;
                text-align: center;
                color: white;
                line-height: 100vh;
                font-size: 1.8rem;
                height: 100%;
                width: 100%;
                background: #303036;
                z-index: 9000;
                opacity: 1;
                transition:0.25s;
            }
            body.loaded::after {
                z-index: -900;
                opacity: 0;
            }
        </style>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                document.body.classList.add('loaded')
            }, 50);
        })
        </script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-s1">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-s1">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
