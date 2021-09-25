<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Page de l'évènement
        </h2>
    </x-slot>

    <x-view.links>
        @include('include.event-links')
    </x-view.links>

    <x-view.section class="bg-s2">
        <x-slot name="title">
            {{$event->theme}} 
        </x-slot>

        <div class="py-2">
            @if($event->isVoting)
                <x-pill bg="s3">Vote en cours</x-pill>
            @else
                <x-pill :bg="$event->isOpen?'green0':'red0'" :color="$event->isOpen?'green1':'red1'">{{ $event->isOpen?'Ouvert':'Terminé et voté'}}</x-pill>
            @endif
            <x-pill :href="page('types-evenement')">{{ ucFirst($event->type) }} <x-event.typeicon :type="$event->type" /></x-pill>
        </div>
        @if($event->team!=="none")   
        <div class="pt-4 flex flex-col w-full font-bold">
            Bordeaux Photo X {{$event->team()->title}}
        </div>
        @endif

        <div class="py-4">
            {{ ucFirst($event->readableDates) }}. @if($event->isOpen)<b>{{ $event->closeIn}}</b>@endif
        </div>
        <div class="pt-2 quillContent">
            @bindPagesRoute($event->description)
        </div>
    </x-view.section>
</x-app-layout>
