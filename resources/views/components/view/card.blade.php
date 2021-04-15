<div class="w-{{ $width?? '1/3'}} p-3 mb-10 rounded">
    @if($href??null)<a href="{{ $href??null }}">@endif
        <div class="relative">
            <img data-src="{{ $src ?? null }}" class="lazyload rounded">
            <div class="absolute w-full h-full" style="transform: translateY(-100%)"></div>
        </div>
    @if($href??null)</a>@endif

    @if($title??null)<h3 class="text-xl pt-2 pl-1 text-p3">{{ $title }}</h3>@endif
</div>