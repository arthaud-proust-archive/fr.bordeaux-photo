<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Photos de l'évènement "{{ $event->title }}"
        </h2>
    </x-slot>



    <x-view.links>
        @authRole('admin') <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer l'évènement" /> @endauthRole
        <x-view.link :href="route('event.show', $event->hashid)" text="Retour à l'évènement" />
        @if($event->isEnded)
            <x-view.link :href="route('vote.show', $event->hashid)" text="Voter" />
        @endif
    </x-view.links>

    <x-view.section title="Photos">
        @foreach($photos as $photo) 
            <x-view.card :title="$photo->title" :src="$photo->photo" />
        @endforeach
    </x-view.section>
</x-app-layout>
