@php
$sitename = config('app.name', 'Laravel');
$title = (isset($pagename)?$pagename.' - ':'').$sitename;
$name = "Rallyes et nocturnes";
$desc = "Participez à des concours photo au coeur de Bordeaux en parcourant la ville à la recherche de la meilleure photo pour le thème choisi.";
$themeColor = "#101010";
$siteurl = config('app.produrl');
@endphp

<!DOCTYPE html>
<html lang="fr" >
    <head prefix="og: http://ogp.me/ns#">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="theme-color">

        <title>{{ $title }}</title>

        <style>
            body::after {
                content:'Photo à Bordeaux';
                position: fixed;
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
        
        <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/litepicker.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/litepicker/dist/css/litepicker.css"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/quill.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>


        <meta name="robots" content="all">
        <meta name="target" content="all">
        <meta name="author" content="Arthaud Proust">
        <meta name="owner" content="Arthaud Prout">
        <meta name="language" content="fr">

        <meta http-equiv="content-language" content="fr" />
        <meta name="url" content="https://{{ $siteurl }}">
        <meta name="identifier-URL" content="https://{{ $siteurl }}">
        <link rel="canonical" href="https://{{ $siteurl }}" />

        <meta name="subject" content="photography">
        <meta name="description" content="{{ $desc }}" />
        <meta name="keywords" content="concours, rallye, nocturnes, photo, photos, street, white, black, arthaud proust, bordeaux, developpeur, informatique">
        <meta name="theme-color" content="{{ $themeColor }}">

        <meta property="og:title" content="{{ $pagename ?? $name }}" />
        <meta property="og:type" content="website" />
        <meta property="og:description" content="{{ $desc }}" />
        <meta property="og:site_name" content="{{ $sitename }}" />
        <meta property="og:url" content="https://{{ $siteurl }}" />
        <meta property="og:locale" content="fr" />
        <meta property="og:image" content="{{ asset('/assets/img/hero.png') }}" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="{{ $title }}" />
        <meta name="twitter:description" content="{{ $desc }}" />
        <meta name="twitter:site" content="https://{{ $siteurl }}" />
        <meta name="twitter:image" content="{{ asset('/assets/img/hero.png') }}" />

        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-title" content="{{ $title }}" />
        <meta name="apple-mobile-web-app-status-bar-style" content="{{ $themeColor }}">


           <!-- Apple meta -->
           <link rel="apple-touch-icon" href="{{ asset('/assets/img/apple-touch-icon.png') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/assets/img/apple-touch-icon-57x57.png') }}" />
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/assets/img/apple-touch-icon-72x72.png') }}" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/img/apple-touch-icon-76x76.png') }}" />
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/assets/img/apple-touch-icon-114x114.png') }}" />
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/assets/img/apple-touch-icon-120x120.png') }}" />
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/assets/img/apple-touch-icon-144x144.png') }}" />
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/assets/img/apple-touch-icon-152x152.png') }}" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/assets/img/apple-touch-icon-180x180.png') }}" />

        <link rel="icon" href="{{ asset('/assets/img/favicon.ico') }}">


        <script type="application/ld+json">
            {
                "@context": "http://schema.org",
                "@type": "Organization",
                "name": "{{ $sitename }}",
                "url": "https://{{ $siteurl }}",
                "address": "Bordeaux",
                "sameAs": [
                    "https://instagram.com/bordeaux_photo",
                    "https://www.facebook.com/photo.a.bordeaux"
                    "https://twitter.com/arthaud_proust"
                ]
            }
        </script>

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-s1">
            @include('components.view.alert')
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if($header ?? null)
            <header class="bg-s1">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
