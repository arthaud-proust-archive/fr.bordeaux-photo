@php

if(!isset($photo)) {
    $photo = $photos[0];
}
if(isset($photo)) {
    $notes = json_decode($photo->notes, true)[Auth::user()->hashid] ?? [];
    $comment = json_decode($photo->comments, true)[Auth::user()->hashid] ?? "";
}

@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Vote des photos de "{{$event->title}}"
        </h2>
    </x-slot>



    <x-view.links>
        @include('include.event-links')
    </x-view.links>

    @if(isset($photo))
        <x-view.section title="{{ $photo->title }}">
            <x-view.card width="full" :title="$photo->title" :src="$photo->photo" />
        </x-view.section>
        <x-view.section width="3" title="Notation">
            <x-form.base :action="route('vote.note', $photo->hashid)" method="POST" submitColor="green" submitText="Je mets cette note">
                <div class="w-full overflow-y-auto flex flex-row md:flex-wrap w-auto">
                @foreach($photo->criteres as $critere)
                    <div class="m-2 flex-shrink-0 w-2/3 sm:w-2/5">
                    <x-form.field optionsNumber type="select" :value="$notes[$loop->index] ?? 6" :label="$critere[0]" :desc="$critere[1]" name="critere{{$loop->index+1}}" :options="$photo->critereOptions"/>
                    </div>
                @endforeach
                    <div class="m-2 flex-shrink-0 w-1/2 sm:w-2/5">
                        <x-form.field :value="$notes[6] ?? 0" type="number" label="Points bonus" desc="Suivant la liste bonus établi, entrez le nombre de points à ajouter" name="bonus"/>
                    </div>
                </div>
                <x-form.field :value="$comment" type="textarea" label="Commentaire (optionnel)" desc="Donnez votre avis, subjectif, objectif, qu'est ce qui pourrait être amélioré?" name="comment"/>
            </x-form.base>
        </x-view.section>
        @if(isset($photos))
            {{ $photos->links('pagination.photo') }}
        @endif
    @else
        {{-- <x-view.section title="Aucune photo">
            <p class="mb-6">Vous avez fini!</p>
            <x-view.link :href="route('vote.display', $event->hashid)" text="Calculer les résultats" />
        </x-view.section> --}}
    @endif
    
</x-app-layout>
