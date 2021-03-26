<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Évènements
        </h2>
    </x-slot>

    @authRole('admin')
    <x-view.section title="Administration">
        <x-view.link :href="route('event.create')" text="Ajouter un évènement" />
    </x-view.section>
    @endauthRole
    @foreach($events as $event)
        <x-view.section :class="$event->type=='rallye'?'invert-theme':'theme-light'">
            <x-slot name="title">
                <a href="{{ route('event.show', $event->hashid) }}">
                    {{$event->title}}
                    <x-event.typeicon :type="$event->type" />
                </a>
            </x-slot>
            @authRole('admin')
            <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer" />
            @endauthRole
            <p class="mt-2">{{ $event->description }}</p>
        </x-view.section>
    @endforeach
</x-app-layout>
