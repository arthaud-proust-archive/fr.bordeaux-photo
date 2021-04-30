@php

if(!isset($photo)) {
    $photo = $photos[0];
}
$criteres = [
    "Réponse au thème" => "Choix du sujet, respect du thème, originalité...",
    "Composition" => "Cadrage, harmonie, lumière...",
    "Technique" => "Exposition, profondeur de champs, traitement...",
    "Critère subjectif" => "Coup de coeur, histoire que ça raconte, émotion..."
];
$options = [
    '0 - Vraiment pas',
    '1 - Pas trop',
    '2 - Limite',
    '3 - Respecté',
    '4 - Très bien',
    '5 - Exceptionnel',
    'Choisir la note'
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
        <x-view.link :href="route('event.photos', $event->hashid)" text="Voir les photos" />
        @if($event->voted)
            <x-view.link :href="route('event.results', $event->hashid)" text="Voir les résultats" />
        @endif
    </x-view.links>

    @if($photo)
        <x-view.section title="{{ $photo->title }}">
            <x-view.card width="full" :title="$photo->title" :src="$photo->photo" />
        </x-view.section>
        <x-view.section width="3" title="Note">
            <x-form.base :action="route('vote.note', $photo->hashid)" method="POST" submitColor="green" submitText="Je mets cette note">
                @foreach($criteres as $critere=>$desc)
                <x-form.field optionsNumber value="0" type="select" :label="$critere" :desc="$desc" name="critere{{$loop->index+1}}" :options="$options"/>
                @endforeach
                <x-form.field value="0" type="number" label="Points bonus" desc="Suivant la liste bonus établi, entrez le nombre de points à ajouter" name="bonus"/>
            </x-form.base>
        </x-view.section>
        @if(isset($photos))
            {{ $photos->links('pagination.photo') }}
        @endif
    @else
        <x-view.section title="Aucune photo">
            <p class="mb-6">Vous avez fini!</p>
            <x-view.link :href="route('vote.display', $event->hashid)" text="Calculer les résultats" />
        </x-view.section>
    @endif
    
</x-app-layout>
