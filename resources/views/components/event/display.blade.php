<div class="flex-grow max-w-2xl" itemscope itemtype="http://schema.org/Event">
    <x-view.section class="bg-s2">
        <x-slot name="title">
                {{$event->title}}
                <div class="text-base inline py-3">
                @authRole('admin')
                <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer" />
                @endauthRole
                <x-view.link :href="route('event.show', $event->hashid)" text="Voir" />

                
                @if($event->isOpen)
                    @authRole('user')
                        @if($event->userPhotoSent)
                        <x-view.link :href="route('photo.edit', $event->userPhotoSent->hashid)" text="Modifier ma photo" />
                        @else
                        <x-view.link :href="route('photo.create', $event->hashid)" text="Envoyer ma photo" />
                        @endif
                    @endauthRole
                    @guest
                    <x-view.link :href="route('photo.create', $event->hashid)" text="Envoyer ma photo" />
                    @endguest
                @endif
                </div>
        </x-slot>

        <x-event.data :event="$event"/>
        <div class="py-2">
            @if($event->isVoting)
                <x-pill bg="s3">Vote en cours</x-pill>
            @else
                <x-pill :bg="$event->isOpen?'green0':'red0'" :color="$event->isOpen?'green1':'red1'">{{ $event->isOpen?'Ouvert':'Fermé'}}</x-pill>
            @endif
            <x-pill>{{ ucFirst($event->type) }} <x-event.typeicon :type="$event->type" /></x-pill>
        </div>

        <div class="py-4">
            {{ ucFirst($event->readableDates) }}. @if(!$event->isEnded)<b>{{ $event->isOpen?$event->closeIn:$event->openIn}}</b>@endif
        </div>

        <div class="quillContent">
            @bindPagesRoute($event->description)
        </div>
    </x-view.section>
</div>