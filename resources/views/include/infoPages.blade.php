@php
use App\Models\Page;
$routes = '<p class="ql-snow ql-toolbar text-sm font-medium text-p1"><span class="block">Pour créer un lien vers une page, il faut mettre <code class="bg-s0 px-1 rounded">page-<span class="text-red0">...hashid</span></code> dans "link" (<svg class="inline h-5 ql-link ql-snow" viewbox="0 0 18 18"><line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line> <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path> <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path></svg>)</span><span class="block">Voici les pages avec leur <b>hashid</b>:</span>';
foreach(Page::select('id', 'title')->get() as $trucmuche) {
    $routes.= $trucmuche->title.': <code class="bg-s0 px-1 rounded text-red0">'.$trucmuche->hashid.'</code>, ';
}
$routes.='</p>';
echo $routes;
@endphp