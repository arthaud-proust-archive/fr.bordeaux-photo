@php 
$haveTitle = isset($title) && !empty(is_string($title)?$title:$title->toHtml());
@endphp 

<div {{ $attributes->merge(['class' => 'grid-card max-w-'.($width ?? 7).'xl rounded-xl sm:rounded-2xl bg-s1 text-p1 overflow-hidden']) }}>
    
    @if($href??null)<a href="{{ $href }}">@endif        
        
        @if($img??null)
            <div class="relative overflow-hidden h-38">
                @if($onImg??null)
                    <img src="{{$img}}">
                    <div class="absolute h-full w-full top-0 bg-shade" style="opacity: 0.45;"></div>
                    <div class="absolute h-full w-full bottom-0 p-6">
                        {{ $onImg }}
                    </div>
                @else
                    <img src="{{$img}}">                        
                @endif
            </div>
        @endif
        <div class="p-6">

        
        
            @if($haveTitle)
                <h1 class="text-3xl pb-3 pt-1 flex flex-wrap flex-row items-center justify-between">{{ $title }}</h1>
            @endif
            <div class="section-content">
                {{ $slot }}
            </div>

        </div>
    @if($href??null)</a>@endif

</div>