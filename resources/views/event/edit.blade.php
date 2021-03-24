<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Éditer un évènement
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('event.delete', $event->hashid)" method="POST" submitBtn="Supprimer (irréversible):red" nobody />
        <x-form.base :action="route('event.edit', $event->hashid)" method="POST" submitColor="green" submitText="Modifier" cancel>
            <x-form.field :bind="$event" type="input" label="Titre" name="title"/>
            <x-form.field :bind="$event" type="select" label="Type" name="type" :options="['rallye'=>'Rallye', 'nocturne'=>'Nocturne']"/>
            <x-form.field :bind="$event" type="textarea" label="Contenu" name="description"/>
            <x-form.field :bind="$event" type="input" label="Date de début" name="date_start"/>
            <x-form.field :bind="$event" type="input" label="Date de fin" name="date_end"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>
