<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Ajouter une info à la une
        </h2>
    </x-slot>
    
    <x-view.section width="3">
        <x-form.base action="route('info.store')" method="POST" submitColor="green">
            <x-form.field type="input" label="Titre" name="title"/>
            <x-form.field type="textarea" label="Contenu" name="content"/>
            <div class="bg-si mt-1 border-si py-2 rounded-md" id="editor"></div>
        </x-form.base>
    </x-view.section>

</x-app-layout>
