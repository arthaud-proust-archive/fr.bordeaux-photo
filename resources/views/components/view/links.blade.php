<div class="py-1">
    <div class="max-w-{{ $width ?? 7 }}xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-2xl">
            <div {{ $attributes->merge(['class' => 'p-6 bg-s1 text-p1 ']) }}
            {{-- border-b border-p3 --}}
            >
                @if($title??null)
                    <h1 class="text-3xl pb-3">{{ $title }}</h1>
                @endif
                <div class="flex flex-wrap">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>