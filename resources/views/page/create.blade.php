<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Créer une page
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('page.store')" method="POST" submitColor="green" submitText="Ajouter" cancel>
            <x-form.field type="input" label="Titre" name="title"/>
            <x-form.field type="url" label="Url de la page" name="url"/>
            <x-form.field type="textarea" label="Contenu" name="description"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>