<x-prop startDate :content="timestampToDate($event->date_start)"/>
<x-prop endDate :content="timestampToDate($event->date_end)"/>
<x-prop isAccessibleForFree content="true"/>
<x-prop description content="Voir le {{$event->type}} sur le site"/>
<x-prop url :content="route('event.show', $event->hashid)"/>
<x-prop name :content="$event->title"/>
<x-prop performer content="Bordeaux Photo"/>
<x-prop eventStatus content="EventScheduled"/>
<x-prop eventAttendanceMode	 content="MixedEventAttendanceMode"/>
<x-prop image :content="asset('/assets/img/hero.png')"/>
<div style="display:none" itemscope itemprop="organizer" itemtype="https://schema.org/Organization">
    <x-prop url :content="route('home')"/>
    <span itemprop="name">Bordeaux Photo</span>
</div>
<div style="display:none" itemscope itemprop="location" itemtype="https://schema.org/Place">
    <x-prop location content="Bordeaux"/>
    <span itemprop="name">Bordeaux Photo</span>
    <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
        <span itemprop="streetAddress">Quais</span>
        <span itemprop="addressLocality">Bordeaux</span>, <span itemprop="addressRegion">Gironde</span> <span itemprop="postalCode">33000</span>
    </div>
</div>