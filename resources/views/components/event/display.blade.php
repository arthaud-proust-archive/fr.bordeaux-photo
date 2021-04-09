<div class="flex-grow max-w-2xl" itemscope itemtype="http://schema.org/Event">
    <x-view.section class="bg-s2">
        <x-slot name="title">
                {{$event->title}}
                @authRole('admin')
                <x-view.link muted :href="route('event.edit', $event->hashid)" text="Éditer" />
                @endauthRole
                <x-view.link muted :href="route('event.show', $event->hashid)" text="Voir" />
        </x-slot>

        <x-prop startDate :content="timestampToDate($event->date_start)"/>
        <x-prop endDate :content="timestampToDate($event->date_end)"/>
        <x-prop isAccessibleForFree content="true"/>
        <x-prop description content="Voir le {{$event->type}} sur le site"/>
        <x-prop url :content="route('event.show', $event->hashid)"/>
        <x-prop name :content="$event->title"/>
        <x-prop organizer content="Bordeaux Photo"/>
        <x-prop organizer.url content="route('home')"/>
        <x-prop performer content="Bordeaux Photo"/>
        <x-prop eventStatus content="EventScheduled"/>
        <x-prop eventAttendanceMode	 content="MixedEventAttendanceMode"/>
        <x-prop image :content="asset('/assets/img/hero.png')"/>
        <div style="display:none" itemscope itemprop="location" itemtype="https://schema.org/Place">
            <x-prop location content="Bordeaux"/>
            <span itemprop="name">Bordeaux Photo</span>
            <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                <span itemprop="streetAddress">Quais</span>
                <span itemprop="addressLocality">Bordeaux</span>, <span itemprop="addressRegion">Gironde</span> <span itemprop="postalCode">33000</span>
            </div>
        </div>
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
            {{ $event->description }}
        </div>
    </x-view.section>
</div>