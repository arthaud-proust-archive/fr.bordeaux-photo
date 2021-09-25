<div class="flex-grow max-w-xl async-card" data-type="event" data-hashid="{{ $event->hashid }}">
    <x-view.section class="bg-s2" :img="$event->img">
        @if($event->team!=="none")   
        <x-slot name="onImg">
            <span class="flex flex-col w-full font-wide text-4xl lg:text-5xl">
                <span>Bordeaux Photo</span>
                <span>X</span>
                <span>{{$event->team()->title}}</span>
            </span>
        </x-slot>
        @endif
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

        

        <div class="py-2 flex flex-row flex-wrap">
            
            @if($event->isStarted)

                @if($event->isOpen)
                    <x-pill bg="green0" color="green1">Ouvert</x-pill>
                @else 

                    @if($event->isVoting )
                        <x-pill bg="s3">Vote en cours</x-pill>
                    @else
                        <x-pill bg="red0" color="red1">Terminé et voté</x-pill>
                    @endif
                @endif

            @else
                <x-pill bg="s3">{{ $event->openIn}}</x-pill>
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

            <!-- {"ops":[{"attributes":{"readmore":true},"insert":"Plus"}]} -->
        {{-- <div class="quillContentAsync"></div> --}}


        <div class="quillContent">
            @bindPagesRoute($event->description)
        </div>

    </x-view.section>
</div>