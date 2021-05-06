@if(!isset($hideOn) || (isset($hideOn) && isset($route) && !request()->routeIs($route)))
<a href="{{ isset($route)?route($route, $params??null) : $href }}" class="m-2 py-2  {{ $muted??null?'px-0 text-t2 hover:text-t1':'px-3 bg-'.($bg??'t1').' hover:bg-'.($hover??'t2').' text-'.($color??'s1')}} rounded-lg">
    {{ $text }}
</a>
@endif