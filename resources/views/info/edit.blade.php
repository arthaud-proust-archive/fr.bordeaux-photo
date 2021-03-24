<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Éditer une info à la une
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('info.delete', $info->hashid)" method="POST" submitBtn="Supprimer (irréversible):red" nobody />
        <x-form.base :action="route('info.edit', $info->hashid)" method="POST" submitColor="green" submitText="Modifier" cancel>
            <x-form.field :bind="$info" type="input" label="Titre" name="title"/>
            <x-form.field :bind="$info" type="textarea" label="Contenu" name="content"/>
            <!-- <x-form.field type="file" label="Contenu" name="content" mimes="images/jpg"/> -->
            <!-- <x-form.field type="checkbox" label="Contenu" name="test1"/> -->
            <!-- <x-form.field type="select" label="Contenu" name="test2" :options="[1,2,3]"/> -->
        </x-form.base>
    </x-view.section>

</x-app-layout>
