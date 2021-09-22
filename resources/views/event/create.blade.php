<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Créer un évènement
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('event.store')" method="POST" submitColor="green" submitText="Ajouter" cancel>
            <x-form.field type="input" label="Thème de l'évènement" name="title" desc="Le thème ne sera affiché que lorque l'évènement aura démarré. <br>Aucune idée du thème choisi? Mettez n'importe quoi en attendant"/>
            <x-form.field type="input" label="Photo de couverture" name="img" desc="Url de l'image, recherche directe: https://source.unsplash.com/800x400/?theme_in_english ou photo directe: https://source.unsplash.com/id_photo"/>
            <x-form.field type="select" label="Type" name="type" :options="App\Models\Event::$types"/>
            <x-form.field type="select" label="Organisé avec" name="feature" :options="$featureTeams"/>

            
            <x-form.field type="date" label="Date" name="dates"/>
            <!-- <x-form.field type="date" label="Date de début" name="date_start" :value="Carbon\Carbon::now()->addDays(1)->toDateString()"/> -->
            <!-- <x-form.field type="date" label="Date de fin" name="date_end" :value="Carbon\Carbon::now()->addDays(1)->toDateString()"/> -->
            <x-form.field type="quill" label="Contenu" name="description"/>
            @infoPagesRoute
        </x-form.base>
    </x-view.section>

</x-app-layout>