<div class="w-{{ $width?? '1/3'}} p-3 mb-10 rounded">
    @if($href??null)<a href="{{ $href??null }}">@endif
        <img data-src="{{ $src ?? null }}" class="lazyload rounded">
    @if($href??null)</a>@endif

    @if($title??null)<h3 class="text-xl pt-2 pl-1 text-p3">{{ $title }}</h3>@endif
</div>