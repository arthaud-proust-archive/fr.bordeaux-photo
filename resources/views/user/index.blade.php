<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Liste des utilisateurs
        </h2>
    </x-slot>

    <div class="flex flex-row flex-wrap max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    @foreach($users as $user)
    <x-view.section :title="$user->name" width="3">
        <x-view.link muted :href="route('user.show', $user->hashid)" text="Voir" />
        <x-view.link muted :href="route('user.edit', $user->hashid)" text="Modifier" />
    </x-view.section>
    @endforeach
    </div>
</x-app-layout>
