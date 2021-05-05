<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Jury de l'évènement
        </h2>
    </x-slot>

    <x-view.links>
        <x-view.link :href="route('event.show', $event->hashid)" text="Retour à l'évènement" />
        @authRole('admin') 
            <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer l'évènement" /> 
        @endauthRole

        @authRole('jury')
            @if($event->isStarted)
            <x-view.link :href="route('event.photos', $event->hashid)" text="Voir les photos" />
            @endif
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
            @guest
                <x-view.link :href="route('photo.create', $event->hashid)" text="Envoyer ma photo" />
            @endguest
        @endif

        @if($event->voted)
            <x-view.link :href="route('event.results', $event->hashid)" text="Voir les résultats" />
        @endif
    </x-view.links>

    <x-view.section class="bg-s2">
        <x-slot name="title">
            Jury de "{{$event->theme}}"
        </x-slot>
        <div class="pt-2">
            Quels sont les juges qui vont noter les photos de cet évènement?
            <div class="mt-3 flex flex-row flex-wrap">
            @foreach($event->juryModels as $jure)
                <x-user.card :user="$jure" />
            @endforeach
            </div>
        </div>
    </x-view.section>
</x-app-layout>
