@php
$sitename = config('app.name', 'Laravel');
$title = (isset($pagename)?$pagename.' - ':'').$sitename;
$name = "Rallyes et nocturnes";
$desc = "Participez à des concours photo au coeur de Bordeaux en parcourant la ville à la recherche de la meilleure photo pour le thème choisi.";
$themeColor = "#101010";
$siteurl = config('app.produrl');
@endphp
{
    "name": "{{ $sitename }}",
    "lang": "fr",
    "short_name": "{{ $sitename }}",
    "description": "{{ $desc }}",
    "theme_color": "{{ $themeColor }}",
    "start_url": "/",
    "display": "fullscreen",
    "icons": [{
        "sizes":"57x57",
        "src":"{{ asset('/assets/img/apple-touch-icon-57x57.png') }}",
        "type": "image/png"
    }, {
        "sizes":"72x72",
        "src":"{{ asset('/assets/img/apple-touch-icon-72x72.png') }}",
        "type": "image/png"
    }, {
        "sizes":"76x76",
        "src":"{{ asset('/assets/img/apple-touch-icon-76x76.png') }}",
        "type": "image/png"
    }, {
        "sizes":"114x114",
        "src":"{{ asset('/assets/img/apple-touch-icon-114x114.png') }}",
        "type": "image/png"
    }, {
        "sizes":"120x120",
        "src":"{{ asset('/assets/img/apple-touch-icon-120x120.png') }}",
        "type": "image/png"
    }, {
        "sizes":"144x144",
        "src":"{{ asset('/assets/img/apple-touch-icon-144x144.png') }}",
        "type": "image/png"
    }, {
        "sizes":"152x152",
        "src":"{{ asset('/assets/img/apple-touch-icon-152x152.png') }}",
        "type": "image/png"
    }, {
        "sizes":"180x180",
        "src":"{{ asset('/assets/img/apple-touch-icon-180x180.png') }}",
        "type": "image/png"
    }]
}