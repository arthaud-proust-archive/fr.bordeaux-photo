<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Mon profil
        </h2>
    </x-slot>

    @authRole('admin')
    <x-view.section title="Administration">
        <x-view.link :href="route('info.create')" text="Ajouter une info à la une" />
    </x-view.section>
    @endauthRole

</x-app-layout>
