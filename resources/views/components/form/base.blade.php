@php
if(isset($submitBtn)) {
    $submitExplo = explode(':', $submitBtn);
    $submitText = $submitExplo[0];
    $submitColor = $submitExplo[1] ?? 'green';
}
@endphp

<form action="{{ $action }}" method="{{ $method }}" enctype="{{ $enctype ?? '' }}">
    @csrf
    {{ $head ?? '' }}
    <div class="sm:overflow-hidden">
        @if(!($nobody ?? ''))
        <div class="px-4 py-5 bg-s2 space-y-6 sm:p-6">
            {{ $slot ?? '' }}
        </div>
        @endif
        
        <div class="px-4 py-3 bg-s2 text-right sm:px-6">
            @if($cancel ?? '')
                <a 
                    {{-- href="{{ $cancel==1?route('dashboard'):$cancel }}" --}}
                    onclick="nav(()=>window.history.back())"
                    class="inline-flex justify-center py-2 px-4 mr-1 border border-transparent text-sm font-medium rounded-md text-p1 hover:bg-s3 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 cursor-pointer">
                    Retour
                </a>
            @endif

            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-{{ $submitColor}}-600 hover:bg-{{ $submitColor}}-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $submitColor}}-500">
                {{ $submitText ?? 'Continuer' }}
            </button>
        </div>
    </div>
</form>