<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Éditer un évènement
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('event.delete', $event->hashid)" method="POST" submitBtn="Supprimer (irréversible):red" nobody />
        <x-form.base :action="route('event.edit', $event->hashid)" method="POST" submitColor="green" submitText="Modifier" cancel>
            <x-form.field :bind="$event" type="input" label="Thème de l'évènement" name="title" desc="Le thème ne sera affiché que lorque l'évènement aura démarré. <br>Aucune idée du thème choisi? Mettez n'importe quoi en attendant"/>
            <x-form.field :bind="$event" type="select" label="Type" name="type" :options="$event->types()"/>
            <x-form.field :bind="$event" type="date" label="Date" name="dates"/>
            <!-- <x-form.field :value="timestampToDate($event->date_start)" type="date" label="Date de début" name="date_start"/> -->
            <!-- <x-form.field :value="timestampToDate($event->date_end)" type="date" label="Date de fin" name="date_end"/> -->
            <x-form.field :bind="$event" type="quill" label="Contenu" name="description"/>
            <x-infopageroute/>
        </x-form.base>
    </x-view.section>

</x-app-layout>