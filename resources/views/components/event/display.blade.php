<div class="flex-grow max-w-2xl">
    <x-view.section class="bg-s2">
        <x-slot name="title">
                {{$event->title}}
                @authRole('admin')
                <x-view.link muted :href="route('event.edit', $event->hashid)" text="Éditer" />
                @endauthRole
                <x-view.link muted :href="route('event.show', $event->hashid)" text="Voir" />
        </x-slot>
        <div class="py-2">
            @if($event->isVoting)
                <x-pill bg="s3">Vote en cours</x-pill>
            @else
                <x-pill :bg="$event->isOpen?'green0':'red0'" :color="$event->isOpen?'green1':'red1'">{{ $event->isOpen?'Ouvert':'Fermé'}}</x-pill>
            @endif
            <x-pill>{{ ucFirst($event->type) }} <x-event.typeicon :type="$event->type" /></x-pill>
        </div>
        <div class="py-4">
            {{ ucFirst($event->readableDates) }}. <b>{{ $event->isOpen?$event->closeIn:$event->openIn}}</b>
        </div>
        <div class="quillContent">
            {{ $event->description }}
        </div>
    </x-view.section>
</div>