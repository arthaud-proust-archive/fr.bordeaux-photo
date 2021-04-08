<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Page de l'évènement
        </h2>
    </x-slot>

    @auth
    <x-view.section>
        @authRole('admin') 
            <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer l'évènement" /> 
        @endauthRole

        @authRole('jury')
            <x-view.link :href="route('event.photos', $event->hashid)" text="Voir les photos" />
            @if($event->isEnded)
                <x-view.link :href="route('vote.show', $event->hashid)" text="Voter" />
            @endif
        @endauthRole

        @if($event->isOpen)
            @authRole('user')
                @if($event->userPhotoSent)
                <x-view.link :href="route('photo.edit', $event->userPhotoSent->hashid)" text="Modifier ma photo" />
                @else
                <x-view.link :href="route('photo.create', $event->hashid)" text="Envoyer ma photo" />
                @endif
            @endauthRole
        @endif

        @if($event->voted)
            <x-view.link :href="route('event.results', $event->hashid)" text="Voir les résultats" />
        @endif
    </x-view.section>
    @endauth

    <x-view.section class="bg-s2">
        <x-slot name="title">
            {{$event->title}} 
        </x-slot>
        <div class="py-2">
            <x-pill :bg="$event->isOpen?'green0':'red0'" :color="$event->isOpen?'green1':'red1'">{{ $event->isOpen?'Ouvert':'Fermé'}}</x-pill>
            <x-pill>{{ ucFirst($event->type) }} <x-event.typeicon :type="$event->type" /></x-pill>
        </div>
        <div class="py-2">
            {{ ucFirst($event->readableDates) }}
        </div>
        <div class="pt-2 quillContent">
            {{ $event->description }}
        </div>
    </x-view.section>
</x-app-layout>
