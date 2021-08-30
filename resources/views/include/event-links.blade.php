<x-view.link hideOn route="event.show" :params="$event->hashid" text="Retour à l'évènement" />
<x-view.link hideOn route="event.jury" :params="$event->hashid" text="Voir le jury ce cet évènement" /> 
@authRole('admin') <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer l'évènement" /> @endauthRole
@authRole('jury')
    @if($event->isStarted && !$event->voted)
    <x-view.link hideOn route="event.photos" :params="$event->hashid" text="Voir les photos" />
    @endif
    @if($event->isVoting)
        <x-view.link hideOn route="vote.show" :params="$event->hashid" text="Voter" />
    @endif
@endauthRole

@auth 
    @if($event->isOpen)
        @authRole('user')
            @if($event->userPhotoSent)
            <x-view.link hideOn route="photo.edit" :params="$event->userPhotoSent->hashid" text="Modifier ma photo" />
            @else
            <x-view.link hideOn route="photo.create" :params="$event->hashid" text="Envoyer ma photo" />
            @endif
        @endauthRole
        @guest
            <x-view.link hideOn route="photo.create" :params="$event->hashid" text="Envoyer ma photo" />
        @endguest
    @endif
@endauth

@if($event->voted)
    <x-view.link hideOn route="event.results" :params="$event->hashid" text="Voir les résultats" />
    @auth 
        @if($event->userPhotoSent)
            <x-view.link hideOn route="photo.show" :params="$event->userPhotoSent->hashid" text="Résultat de ma photo" />
        @endif
    @endauth
@endif