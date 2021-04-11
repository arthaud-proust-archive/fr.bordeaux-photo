<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Liste des pages
        </h2>
    </x-slot>

    <x-view.links>
        <x-view.link :href="route('page.create')" text="Créer une page" />
    </x-view.links>


    <div class="flex flex-row flex-wrap max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    @foreach($pages as $page)
    <x-view.section :title="$page->title" width="3" class="bg-s2">
        <x-view.link muted :href="route('page.show', $page->url)" text="Voir" />
        <x-view.link muted :href="route('page.edit', $page->hashid)" text="Modifier" />
    </x-view.section>
    @endforeach
    </div>
</x-app-layout>
