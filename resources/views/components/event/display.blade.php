<x-view.gridSection class="max-w-xl bg-s2" :img="$event->img" data-type="event" data-hashid="{{ $event->hashid }}">
    @if($event->team!=="none")   
    <x-slot name="onImg">
        <span class="select-none flex flex-col items-start justify-end h-full w-full  text-p2">
            <span class="text-xl">Bordeaux Photo avec</span>
            <!-- <span class="my-2">Avec</span> -->
            <span class="text-4xl md:text-5xl font-wide tracking-wider">{{$event->team()->title}}</span>
        </span>
    </x-slot>
    @endif
    <x-slot name="title">
        {{$event->theme}}
        <div class="text-base flex flex-row flex-wrap -ml-2 py-3">
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
        Bordeaux Photo & {{$event->team()->title}}
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

</x-view.gridSection>