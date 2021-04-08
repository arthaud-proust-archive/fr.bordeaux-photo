<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Anciens évènements
        </h2>
    </x-slot>

    <x-view.section>
        <x-view.link :href="route('event.index')" text="Voir les évènements récents" />
        @authRole('admin')
        <x-view.link :href="route('event.create')" text="Ajouter un évènement" />
        @endauthRole
    </x-view.section>
    @foreach($events as $event)
        <x-view.section class="bg-s2">
            <x-slot name="title">
                <a href="{{ route('event.show', $event->hashid) }}">
                    {{$event->title}}
                </a>
                @authRole('admin')
                <x-view.link muted :href="route('event.edit', $event->hashid)" text="Éditer" />
                @endauthRole
                <x-view.link muted :href="route('event.show', $event->hashid)" text="Voir" />
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
    @endforeach

    <x-view.section>
        {{$events->links()}}
    </x-view.section>
</x-app-layout>
