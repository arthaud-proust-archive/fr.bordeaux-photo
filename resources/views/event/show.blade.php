<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    @auth
    <x-view.section title="Liens">
        @authRole('admin') <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer l'évènement" /> @endauthRole
        <x-view.link :href="route('event.photos', $event->hashid)" text="Voir les photos" />
        <x-view.link :href="route('event.results', $event->hashid)" text="Voir les résultats" />
        @if($event->userPhotoSent)
        <x-view.link :href="route('photo.edit', $event->userPhotoSent->hashid)" text="Modifier ma photo" />
        @else
        <x-view.link :href="route('photo.create', $event->hashid)" text="Envoyer ma photo" />
        @endif
    </x-view.section>
    @endauth

    <x-view.section :class="$event->type=='rallye'?'invert-theme':'theme-light'">
        <x-slot name="title">
            <a href="{{ route('event.show', $event->hashid) }}">
                {{$event->title}}
                <x-event.typeicon :type="$event->type" />
            </a>
        </x-slot>
        <p class="mt-2">{{ $event->description }}</p>
    </x-view.section>
</x-app-layout>
