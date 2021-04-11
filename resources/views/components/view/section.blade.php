<div class="py-8">
    <div class="max-w-{{ $width ?? 7 }}xl mx-auto px-3 sm:px-6 lg:px-8">
        <div class="">
        <!-- <div class="overflow-hidden sm:rounded-2xl"> -->
            @if($href??null)<a href="{{ $href }}">@endif            
            <div {{ $attributes->merge(['class' => 'rounded-xl sm:rounded-2xl p-6 bg-s1 text-p1 ']) }}
            {{-- border-b border-p3 --}}
            >
                
                @if($title??null)
                    <h1 class="text-3xl pb-3 pt-1">{{ $title }}</h1>
                @endif
                <div>
                    {{ $slot }}
                </div>

                </div>
            @if($href??null)</a>@endif
        </div>
    </div>
</div>