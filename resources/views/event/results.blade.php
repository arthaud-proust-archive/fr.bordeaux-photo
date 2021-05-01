@php 
$podiumArray = [
    [1,'second', '4/12'],
    [0,'first', '2/5'],
    [2,'third', '3/12']
];
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Résultats de l'évènement "{{ $event->title }}"
        </h2>
    </x-slot>



    <x-view.links>
        @authRole('admin') <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer l'évènement" /> @endauthRole
        <x-view.link :href="route('event.show', $event->hashid)" text="Retour à l'évènement" />
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
    @endif
    <x-view.section title="Résultats">
        <div class="flex flex-row flex-wrap">
            @foreach($results as $result) 
                <x-view.card width="full" :src="$result->photo">
                    <x-slot name="title">
                        <span class="text-xl text-p1">#{{ ($results->currentPage()-1) * $results->perPage() + $loop->index+1 }}</span>
                        <span class="text-sm">
                            {{ $result->title }} par {{ $result->authorModel->name }}
                            <!-- <x-view.link muted href="{{ route('profil.show', $result->author) }}" :text="$result->authorModel->name" /> -->
                        </span>
                    </x-slot>
                </x-view.card>

            @endforeach
        </div>
        {{$results->links()}}
    </x-view.section>
    @else
        <x-view.section title="Les résultats seront affichés une fois que le jury aura voté"></x-view.section>
    @endif
    

    
</x-app-layout>
