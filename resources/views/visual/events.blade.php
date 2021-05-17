<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Les visuels des évènements
        </h2>
    </x-slot>

    <x-view.section>
        <span>Clique sur une image pour la télécharger</span>
    </x-view.section>
    <div class="flex flex-row flex-wrap max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @foreach($events as $event)
        <div class="visual event"
            data-type="{{ $event->type }}"
            data-typeicon="{{ asset('assets/'.$event->type.'.svg') }}"
            data-theme="{{ $event->theme }}"
            data-dates="{{ ucFirst($event->readableDates) }}"
        >
            <canvas>
        </div>
        @endforeach
    </div>
    <script src="{{ asset('js/visual.js') }}"></script>
</x-app-layout>
