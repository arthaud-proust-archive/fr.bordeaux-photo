@php 
$podiumArray = [
    ['first', 'Première place'],
    ['second', 'Deuxième place'],
    ['third', 'Troisième place']
];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Liste des types de visuels à télécharger
        </h2>
    </x-slot>

    <x-view.section class="bg-s2">
        <x-slot name="title">
            {{$event->theme}} 
        </x-slot>

        <div class="py-2">
            @if($event->isVoting)
                <x-pill bg="s3">Vote en cours</x-pill>
            @else
                <x-pill :bg="$event->isOpen?'green0':'red0'" :color="$event->isOpen?'green1':'red1'">{{ $event->isOpen?'Ouvert':'Terminé et voté'}}</x-pill>
            @endif
            <x-pill :href="page('types-evenement')">{{ ucFirst($event->type) }} <x-event.typeicon :type="$event->type" /></x-pill>
        </div>
        <div class="py-2">
            {{ ucFirst($event->readableDates) }}
        </div>
    </x-view.section>

    <div class="flex flex-row flex-wrap max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        @foreach($podium as $result)
        <div class="visual"
            data-image="{{ $result->photo }}"
            data-author="{{ $result->authorModel->name }}"
            data-event="{{ $event->title }}"
            {{-- data-laureats=["{{ asset('assets/'.$podiumArray[$result->place-1][0].'.svg') }}"] --}}
            data-laureats="{{json_encode([$podiumArray[$result->place-1][1]])}}"
        >
        </div>
        <!-- <x-view.card width="full md:w-1/3" :src="$result->photo">
            <x-slot name="title">
                <div class="flex w-full flex-row justify-center">
                    <img class="m-1 w-1/2 inline-block" 
                    src="{{ asset('assets/'.$podiumArray[$result->place-1][0].'.svg') }}">
                </div>
            </x-slot>
        </x-view.card> -->
        @endforeach

        @foreach($nomineds as $nomined)
        <div class="visual"
            data-image="{{ $nomined->photo }}"
            data-author="{{ $nomined->authorModel->name }}"
            data-event="{{ $event->title }}"
            {{-- data-laureats="{{ json_encode(array_map(function($nomination) use($nomined) {return asset('assets/'.$nomined->criteres[$nomination][2][1].'.svg');}, json_decode($nomined->nominations)) ) }}" --}}
            data-laureats="{{ json_encode(array_map(function($nomination) use($nomined) {return $nomined->criteres[$nomination][2][0];}, json_decode($nomined->nominations)) ) }}"
        >
        </div>
        <!-- <x-view.card width="full md:w-1/3" :src="$nomined->photo">
            <x-slot name="title">
                <div class="flex w-full flex-row justify-center">
                @foreach(json_decode($nomined->nominations, true) as $nomination) 
                    <img class="m-1 w-1/2 inline-block" 
                    src="{{ asset('assets/'.$nomined->criteres[$nomination][2][1].'.svg') }}" title="{{ $nomined->criteres[$nomination][2][0] }}">
                @endforeach
                </div>
            </x-slot>
        </x-view.card> -->
        @endforeach


        <script src="{{ asset('js/visual.js') }}"></script>
    </div>
</x-app-layout>
