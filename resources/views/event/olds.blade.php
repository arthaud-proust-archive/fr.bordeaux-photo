<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight">
            Anciens évènements
        </h1>
        @if($onlyOlds)
            <span class="mt-2 ml-4 text-p1 text-xl">
                Actuellement aucun évènement n'est annoncé. Nous en prévoyons pour bientôt!
            </span>
        @endif
    </x-slot>

    <x-view.links>
        @if(!$onlyOlds)
            <x-view.link :href="route('event.index')" text="Voir les évènements récents" color="p2" bg="s2" hover="s3" />
        @endif
        
        @authRole('admin')
        <x-view.link :href="route('event.create')" text="Ajouter un évènement" />
        @endauthRole
    </x-view.links>
    
    <div class="mx-2 sm:mx-auto sm:px-6 lg:px-8 max-w-7xl items-start grid grid-adaptive grid-cols-1 lg:grid-cols-2 auto-rows-auto gap-4">
    @foreach($events as $event)
        <x-event.display links :event="$event"/>
    @endforeach
    </div>

    <x-view.section>
        {{$events->links()}}
    </x-view.section>
</x-app-layout>
