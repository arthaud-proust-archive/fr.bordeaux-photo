<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Event",
      "name": "{{ $event->title }}",
      "isAccessibleForFree": true,
      "url": "{{ route('event.show', $event->hashid) }}",
      "startDate": "{{ timestampToDate($event->date_start) }}",
      "endDate": "{{ timestampToDate($event->date_end) }}",
      "eventAttendanceMode": "https://schema.org/MixedEventAttendanceMode",
      "eventStatus": "https://schema.org/EventScheduled",
      "location": {
        "@type": "Place",
        "name": "Bordeaux",
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "Quais",
          "addressLocality": "Bordeaux",
          "postalCode": "33000",
          "addressRegion": "Gironde",
          "addressCountry": "France"
        }
      },
      "image": [
        "{{ asset('/assets/img/hero.png') }}"
       ],
      "description": "Voir le {{$event->type}} sur le site",
      "offers": {
        "@type": "Offer",
        "url": "{{ route('event.show', $event->hashid) }}",
        "price": "0",
        "priceCurrency": "EURO",
        "availability": "https://schema.org/InStock",
        "validFrom": "{{ timestampToDate($event->date_start) }}"
      },
      "performer": {
        "@type": "PerformingGroup",
        "name": "Bordeaux Photo"
      },
      "organizer": {
        "@type": "Organization",
        "name": "Bordeaux Photo",
        "url": "{{ route('event.index') }}"
      }
    }
</script>

{{--
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
--}}