<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Photo à Bordeaux
        </h2>
    </x-slot>

    @authRole('admin')
    <x-view.section title="Administration">
        <x-view.link :href="route('info.create')" text="Ajouter une info à la une" />
    </x-view.section>
    @endauthRole

    @foreach($infos as $info) 
    <x-view.section :title="$info->title">
        <x-view.link :href="route('info.edit', $info->hashid)" text="Éditer" />
        <p class="mt-2">{{ $info->content }}</p>
    </x-view.section>
    @endforeach
</x-app-layout>
