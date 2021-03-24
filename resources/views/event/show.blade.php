<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Évènements
        </h2>
    </x-slot>

    @auth
    <x-view.section title="Administration">
        <x-view.link :href="route('event.create')" text="Ajouter un évènement" />
    </x-view.section>
    @endauth

    @foreach($events as $event) 
    <x-view.section :title="$event->title">
        <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer" />
        {{ $event->content }}
    </x-view.section>
    @endforeach
</x-app-layout>
