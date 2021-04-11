<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Ajouter une info à la une
        </h2>
    </x-slot>
    
    <x-view.section width="3">
        <x-form.base :action="route('info.store')" method="POST" submitColor="green">
            <x-form.field type="input" label="Titre" name="title"/>
            <x-form.field type="quill" label="Contenu" name="content"/>
            @infoPagesRoute
            <div>
                <label class="block text-sm font-medium text-p1">Pages</label>
                @foreach($pages as $page)
                @if($page->url =='/')
                <x-form.field type="checkbox" value :label="$page->title" name="pages[{{$page->hashid}}]"/>
                @else
                <x-form.field type="checkbox" :label="$page->title" name="pages[{{$page->hashid}}]"/>
                @endif
                @endforeach
            </div>
        </x-form.base>
    </x-view.section>
</x-app-layout>
