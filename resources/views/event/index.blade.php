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
    <x-view.section :class="$event->type=='rallye'?'invert-theme':'theme-light'">
        <x-slot name="title">
            {{$event->title}}
            <x-event.typeicon :type="$event->type" />
        </x-slot>
        <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer" />
        <p class="mt-2">{{ $event->description }}</p>
    </x-view.section>
    @endforeach
</x-app-layout>
