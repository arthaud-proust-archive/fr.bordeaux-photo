@php

$notes = json_decode($photo->final_notes, true);
$jury = $event->juryModels;
$comments = json_decode($photo->comments, true);

$podium = [
    'first',
    'second',
    'third'
];

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Votre photo de "{{$event->title}}" (vous êtes le seul à pouvoir regarder cette page)
        </h2>
    </x-slot>



    <x-view.links>
        @include('include.event-links')
    </x-view.links>


    <x-view.section title="{{ $photo->title }}">
        <x-view.card width="full" :title="$photo->title" :src="$photo->photo" />
    </x-view.section>
    
    @if(count(json_decode($photo->nominations, true)) > 0 || $photo->place <=3)
    <x-view.section width="3" title="Lauréats">
        @if($photo->place <=3)
            <img class="m-1 w-4/12 md:w-4/12 inline-block" src="{{ asset('assets/'.$podium[$photo->place-1].'.svg') }}">
        @endif
        @foreach(json_decode($photo->nominations, true) as $nomination) 
            <img class="m-1 w-4/12 md:w-4/12 inline-block" src="{{ asset('assets/'.$photo->criteres[$nomination][2][1].'.svg') }}" title="{{ $photo->criteres[$nomination][2][0] }}">
        @endforeach
    </x-view.section>
    @endif

    <x-view.section width="3" title="Notes">
        <div class="w-full flex flex-row flex-wrap w-auto">
            @foreach($photo->criteres as $critere)
                <div class="m-2 flex-shrink-0 w-2/3 sm:w-2/5">
                <h5 class="text-2xl">{{$critere[0]}}</h5>
                <span>{{ $notes[$loop->index] }} / {{ count($photo->critereOptions)-2 }}</span>
                </div>
            @endforeach
            <div class="m-2 flex-shrink-0 w-1/2 sm:w-2/5">
                <h5 class="text-2xl">Points bonus</h5>
                <span>{{ last($notes) }} </span>
            </div>
            <div class="m-2 flex-shrink-0 w-1/2 sm:w-2/5">
                <span class="">Place finale</span>
                <h5 class="text-2xl">{{ $photo->place }}<sup>e</sup></h5>
            </div>
        </div>
    </x-view.section>

    <x-view.section width="3" title="Commentaires du jury">
            @foreach($jury as $juge)
                @if(array_key_exists($juge->hashid, $comments))
                <x-user.comment :user="$juge" :content="$comments[$juge->hashid]" />
                @endif
            @endforeach
    </x-view.section>

    
</x-app-layout>
