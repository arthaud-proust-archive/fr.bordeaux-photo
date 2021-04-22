<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Créer une page
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('page.delete', $page->hashid)" method="POST" submitBtn="Supprimer (irréversible):red" nobody />
        <x-form.base :action="route('page.update', $page->hashid)" method="POST" submitColor="green" submitText="Modifier" cancel>
            <x-form.field :bind="$page" type="input" label="Titre" name="title"/>
            <x-form.field :bind="$page" type="url" label="Url de la page" name="url"/>
            <x-form.field :bind="$page" type="textarea" label="Contenu" name="description"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>