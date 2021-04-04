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
    <x-view.section>
        <x-slot name="title">
            {{ $info->title}}
            @authRole('admin')
            <x-view.link muted :href="route('info.edit', $info->hashid)" text="Éditer" />
            @endauthRole
        </x-slot>
        <div class="mt-2 quillContent">
            {{ $info->content }}
            {{-- @quillContent($info->content) --}}
        </div>

    </x-view.section>
    @endforeach
</x-app-layout>
