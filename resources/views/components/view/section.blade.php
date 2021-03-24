<div class="py-8">
    <div class="max-w-{{ $width ?? 7 }}xl mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden sm:rounded-lg">
            <div {{ $attributes->merge(['class' => 'p-6 bg-s1 text-p1 ']) }}
            {{-- border-b border-p3 --}}
            >
                @if($title??null)
                    <h1 class="text-3xl pb-3">{{ $title }}</h1>
                @endif
                <p>
                    {{ $slot }}
                </p>
            </div>
        </div>
    </div>
</div>