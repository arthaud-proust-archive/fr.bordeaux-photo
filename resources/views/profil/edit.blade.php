<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Éditer mon profil
        </h2>
    </x-slot>

    <x-view.section width="3">
        <!-- <x-form.base :action="route('profil.delete')" method="POST" submitBtn="Supprimer mon compte:red" nobody /> -->
        <x-form.base :action="route('profil.update')" method="POST" submitColor="green" submitText="Modifier" cancel>
            <x-form.field :bind="$user" type="input" label="Nom" name="name"/>
            <x-form.field :bind="$user" type="input" label="Email" name="email" disabled/>
            <x-form.field :bind="$user" type="quill" label="Bio" name="bio"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>