<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Évènements
        </h2>
    </x-slot>

    <x-view.links>
        @if($oldEvents)
        <x-view.link :href="route('event.index.olds')" text="Voir les anciens évènements" color="p2" bg="s2" hover="s3"/>
        @endif
        @authRole('admin')
        <x-view.link :href="route('event.create')" text="Ajouter un évènement" />
        @endauthRole
    </x-view.links>

    <div class="mx-auto sm:px-6 lg:px-8 max-w-7xl justify-center sm:justify-start flex flex-row flex-wrap">
    @foreach($events as $event)
        <x-event.display links :event="$event"/>
    @endforeach
    </div>

    <x-view.section>
        {{$events->links()}}
    </x-view.section>
</x-app-layout>
