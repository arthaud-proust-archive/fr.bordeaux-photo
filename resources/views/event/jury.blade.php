<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Jury de l'évènement
        </h2>
    </x-slot>

    <x-view.links>
        @include('include.event-links')
    </x-view.links>

    <x-view.section class="bg-s2">
        <x-slot name="title">
            Jury de "{{$event->theme}}"
        </x-slot>
        <div class="pt-2">
            Quels sont les juges qui vont noter les photos de cet évènement?
            <div class="mt-3 flex flex-row flex-wrap">
            @foreach($event->juryModels as $jure)
                <x-user.card :user="$jure" />
            @endforeach
            </div>
        </div>
    </x-view.section>
</x-app-layout>
