@php
$width = $width??'1/3';
$baseClass = "flex flex-col items-center w-".$width." p-3 mb-10 rounded";
@endphp
<div {{ $attributes->merge(['class'=>$baseClass]) }} >
    @if($href??null)<a href="{{ $href??null }}">@endif
        <div class="relative">
            <img data-src="{{ $src ?? null }}" class="w-32 lazyload rounded-full">
            <div class="absolute w-full h-full" style="transform: translateY(-100%)"></div>
        </div>
    @if($href??null)</a>@endif

    @if($title??null)<h2 class="text-3xl pt-2 pl-1 text-p1">{{ $title }}</h2>@endif
    @if($subtitle??null)<h4 class="quillContent text-xl pt-1 pl-1 text-p3">{{ $subtitle }}</h4>@endif

    {{ $slot }}
</div>