@php
$podium = [
    'first',
    'second',
    'third'
];
@endphp
<x-view.card width="full" class="mb-12" :src="$photo->photo">
    <x-slot name="title">
        <span class="text-xl text-p1">#{{ $photo->place }} à <x-view.link muted route="event.show" :params="$photo->event" :text="$photo->getEvent()->title" /></span>
        @if($photo->title)
        <span class="text-sm">
            - "{{ $photo->title }}"
        </span>
        @endif
        <div class="pl-6 inline">
        @if(0 < $photo->place && $photo->place <=3)
            <img class="m-1 w-16 md:w-32 inline-block" src="{{ asset('assets/'.$podium[$photo->place-1].'.svg') }}">
        @endif
        @foreach(json_decode($photo->nominations, true) as $nomination) 
            <img class="m-1 w-16 md:w-32 inline-block" src="{{ asset('assets/'.$photo->criteres[$nomination][2][1].'.svg') }}" title="{{ $photo->criteres[$nomination][2][0] }}">
        @endforeach
        </div>
    </x-slot>
</x-view.card>