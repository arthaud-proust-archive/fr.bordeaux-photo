<div class="flex-grow max-w-xl async-card" data-type="event" data-hashid="{{ $event->hashid }}">
    <x-view.section class="bg-s2">
        <x-slot name="title">
                {{$event->theme}}
                <div class="text-base inline py-3">
                @authRole('admin')
                <x-view.link :href="route('event.edit', $event->hashid)" text="Éditer" />
                @endauthRole
                <x-view.link :href="route('event.show', $event->hashid)" text="Voir" />

                @if($event->isVoting)
                    @authRole('jury')
                        <x-view.link route="vote.show" :params="$event->hashid" text="Voter" />
                    @endauthRole
                @endif
                
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

                @if($event->voted)
                    <x-view.link :href="route('event.results', $event->hashid)" text="Résultats" />
                @endif
                </div>
        </x-slot>

        <x-event.data :event="$event"/>
        <div class="py-2 flex flex-row flex-wrap space-y-1">
            @if($event->isVoting)
                <x-pill bg="s3">Vote en cours</x-pill>
            @endif

            @if($event->isStarted)
                <x-pill :bg="$event->isOpen?'green0':'red0'" :color="$event->isOpen?'green1':'red1'">{{ $event->isOpen?'Ouvert':'Terminé et voté'}}</x-pill>
            @else
                <x-pill bg="s3">{{ $event->openIn}}</x-pill>
            @endif
            <x-pill :href="page('types-evenement')">{{ ucFirst($event->type) }} <x-event.typeicon :type="$event->type" /></x-pill>
        </div>

        <div class="py-4">
            {{ ucFirst($event->readableDates) }}. @if($event->isOpen)<b>{{ $event->closeIn}}</b>@endif
        </div>

            <!-- {"ops":[{"attributes":{"readmore":true},"insert":"Plus"}]} -->
        {{-- <div class="quillContentAsync"></div> --}}
        <div class="quillContent">
            @bindPagesRoute($event->description)
        </div>

    </x-view.section>
</div>