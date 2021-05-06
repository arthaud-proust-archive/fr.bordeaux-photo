@php 
$podiumArray = [
    [1,'second', '4/12'],
    [0,'first', '2/5'],
    [2,'third', '3/12']
];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-4xl text-p1 leading-tight">
            Résultats de l'évènement "{{ $event->title }}"
        </h1>
    </x-slot>



    <x-view.links>
        @include('include.event-links')
    </x-view.links>

    @if( ($podium[0] ?? false) && $event->voted )
    {{-- <x-view.section title="Le gagnant du concours est {{ $podium[0]->authorModel->name}}!"></x-view.section> --}}

    @if($results->currentPage()==1)
    <x-view.section title="Podium gagnant" class="p-0 md:p-6">
        <div class="flex flex-row flex-wrap justify-center items-end">
            @foreach($podiumArray as $place)
                @if( $podium[1] ?? false)
                <x-view.card :width="$place[2]" :title="$podium[$place[0]]->title" :src="$podium[$place[0]]->photo">
                    <x-slot name="title">
                        <img class="mx-auto block w-12 md:w-24 mt-6" src="{{ asset('assets/'.$place[1].'.svg') }}">
                        {{-- <span class="text-5xl mx-auto block text-center">{{ $place[1] }}</span> --}}
                        <!-- {{ $podium[1]->title }} par <x-view.link muted href="{{ route('profil.show', $podium[1]->author) }}" :text="$podium[1]->authorModel->name" /> -->
                    </x-slot>
                </x-view.card>
                @endif
            @endforeach
        </div>
    </x-view.section>

        @if($nomineds->count()>0)
        <x-view.section title="Lauréats" class="p-0 md:p-6">
            <div class="flex flex-row flex-wrap items-start justify-center">
                @foreach($nomineds as $nomined)
                    <x-view.card width="full md:w-1/3" :src="$nomined->photo">
                        <x-slot name="title">
                        <div class="flex w-full flex-row justify-center">
                        @foreach(json_decode($nomined->nominations, true) as $nomination) 
                            <img class="m-1 w-1/2 inline-block" src="{{ asset('assets/'.$nomined->criteres[$nomination][2][1].'.svg') }}" title="{{ $nomined->criteres[$nomination][2][0] }}">
                        @endforeach
                        </div>
                        </x-slot>
                    </x-view.card>
                @endforeach
            </div>
        </x-view.section>
        @endif
    @endif
    <x-view.section title="Résultats">
        <div class="flex flex-row flex-wrap">
            @foreach($results as $result) 
                <x-event.result :result="$result" :results="$results" :loop="$loop" />
            @endforeach
        </div>
        {{$results->links()}}
    </x-view.section>
    @else
        <x-view.section title="Les résultats seront affichés une fois que le jury aura voté"></x-view.section>
    @endif
    

    
</x-app-layout>
