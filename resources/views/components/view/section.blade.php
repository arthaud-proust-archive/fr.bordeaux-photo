@php 
$haveTitle = isset($title) && !empty($title->toHtml());
@endphp 
<div class="py-2 md:py-6">
    <div class="max-w-{{ $width ?? 7 }}xl mx-auto px-3 sm:px-4 lg:px-4">
        <div class="">
        <!-- <div class="overflow-hidden sm:rounded-2xl"> -->
            @if($href??null)<a href="{{ $href }}">@endif            
            <div {{ $attributes->merge(['class' => 'rounded-xl sm:rounded-2xl p-6 bg-s1 text-p1 ']) }}
            {{-- border-b border-p3 --}}
            >
                
                @if($haveTitle)
                    <h1 class="text-3xl pb-3 pt-1 flex flex-wrap flex-row items-center justify-between">{{ $title }}</h1>
                @endif
                <div class="section-content">
                    {{ $slot }}
                </div>

                </div>
            @if($href??null)</a>@endif
        </div>
    </div>
</div>