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
        <x-form.base :action="route('photo.store')" method="POST" cancel submitColor="green" enctype="multipart/form-data">
            <x-form.field :value="$event" type="select" label="Évènement" name="event" :options="$events_list" desc="Seul les évènements ouverts apparaissent"/>
            <x-form.field type="input" label="Titre (optionnel)" name="title" placeholder="Il pourrait aider à mieux comprendre" desc="Maximum 20 caractères, la photo doit néanmoins être compréhensible sans le titre"/>
            <x-form.field type="file" label="Photo" name="photo" mimes="image/png, image/jpeg, image/gif"/>
            <x-form.field type="checkbox" label="J'atteste que la photo a été prise dans la ville, selon les règles du concours" name="taked_at_bdx" />
        </x-form.base>
    </x-view.section>

</x-app-layout>
