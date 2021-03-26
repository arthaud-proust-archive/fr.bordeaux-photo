<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Résultats de l'évènement "{{ $event->title }}"
        </h2>
    </x-slot>



    @auth
    <x-view.section title="Liens">
        @authRole('admin') <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer l'évènement" /> @endauthRole
        <x-view.link :href="route('event.show', $event->hashid)" text="Retour à l'évènement" />
        <x-view.link :href="route('event.photos', $event->hashid)" text="Voir les photos" />
    </x-view.section>
    @endauth

    <x-view.section title="Résultats">
        @foreach($results as $result) 
            <x-view.card :src="$result->path" />
        @endforeach
    </x-view.section>
</x-app-layout>
