@php

$photo = $photos[0];
$options = [
    '0 - Vraiment pas',
    '1 - Pas trop',
    '2 - Limite',
    '3 - Respecté',
    '4 - Très bien',
    '5 - Exceptionnel'
];

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Vote des photos de "{{$event->title}}"
        </h2>
    </x-slot>



    <x-view.links>
        <x-view.link :href="route('event.show', $event->hashid)" text="Retour à l'évènement" />
        <x-view.link :href="route('event.results', $event->hashid)" text="Voir les résultats" />
    </x-view.links>

    @if($photo)
        <x-view.section title="{{ $photo->id}} {{$photo->hashid}}">
            <x-view.card width="full" :title="$photo->title" :src="$photo->photo" />
        </x-view.section>
        <x-view.section width="3" title="Note">
            <x-form.base :action="route('vote.note', $photo->hashid)" method="POST" submitColor="green" submitText="Je mets cette note">
                @for($i=1; $i<5; $i++)
                <x-form.field optionsNumber value="3" type="select" label="Critère n°{{$i}}" name="critere{{$i}}" :options="$options"/>
                @endfor
            </x-form.base>
        </x-view.section>
        {{ $photos->links('pagination.photo') }}
    @else
        <x-view.section title="Aucune photo">
            <p class="mb-6">Vous avez fini!</p>
            <x-view.link :href="route('vote.display', $event->hashid)" text="Calculer les résultats" />
        </x-view.section>
    @endif
    
</x-app-layout>
