<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Éditer un évènement
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('event.store')" method="POST" submitColor="green" submitText="Ajouter" cancel>
            <x-form.field type="input" label="Titre" name="title"/>
            <x-form.field type="select" label="Type" name="type" :options="['rallye'=>'Rallye', 'nocturne'=>'Nocturne']"/>
            <x-form.field type="textarea" label="Contenu" name="description"/>
            <x-form.field type="input" label="Date de début" name="date_start"/>
            <x-form.field type="input" label="Date de fin" name="date_end"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>
