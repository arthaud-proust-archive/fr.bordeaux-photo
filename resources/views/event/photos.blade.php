<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Photos de l'évènement "{{ $event->title }}"
        </h2>
    </x-slot>



    <x-view.links>
        @include('include.event-links')
    </x-view.links>

    <x-view.section title="Photos">
        <div class="flex flex-row flex-wrap">
        @foreach($photos as $photo) 
            @if(Auth::user()->hasRole('jury') && $event->isVoting)
            <x-view.card width="1/2" :href="route('vote.show', ['hashid'=>$event->hashid, 'photo'=>$photo->hashid])" :title="$photo->title" :src="$photo->photo" subtitle="Cliquer sur l'image pour modifier la note"/>
            @else
            <x-view.card width="1/2" :title="$photo->title" :src="$photo->photo"/>
            @endif
        @endforeach
        </div>
    </x-view.section>
</x-app-layout>
