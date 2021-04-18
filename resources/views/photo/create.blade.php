@php
$events_list = [];
foreach($events as $ev) {
    $events_list[$ev['hashid']] = $ev['title'];
}
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Ajouter une photo
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('photo.store')" method="POST" cancel submitColor="green"  enctype="multipart/form-data">
            <x-form.field :value="$event" type="select" label="Évènement" name="event" :options="$events_list" desc="Seul les évènements ouverts apparaissent"/>
            <x-form.field type="input" label="Titre (optionnel)" name="title" placeholder="Il pourrait donner un sens à votre photo"/>
            <x-form.field type="file" label="Photo" name="photo" mimes="image/png, image/jpeg, image/gif"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>
