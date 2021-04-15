<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Éditer une info
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('info.delete', $info->hashid)" method="POST" submitBtn="Supprimer (irréversible):red" nobody />
        <x-form.base :action="route('info.edit', $info->hashid)" method="POST" submitColor="green" submitText="Modifier" cancel>
            <x-form.field :bind="$info" type="input" label="Titre" name="title"/>
            <x-form.field :bind="$info" type="quill" label="Contenu" name="content" placeholder="Contenu"/>
            @infoPagesRoute
            <div>
                <label class="block text-sm font-medium text-p1">Afficher l'info sur les pages:</label>
                @foreach($pages as $page)
                    <x-form.field type="checkbox" :value="$info->inPage($page->hashid)" :label="$page->title" name="pages[{{$page->hashid}}]"/>
                @endforeach
            </div>
        </x-form.base>
    </x-view.section>

</x-app-layout>
