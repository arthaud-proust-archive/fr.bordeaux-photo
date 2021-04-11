<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight">
            Photo à Bordeaux
        </h1>
    </x-slot>

    @authRole('admin')
    <x-view.section title="Administration">
        <x-view.link :href="route('info.create')" text="Ajouter une info à la une" />
    </x-view.section>
    @endauthRole

    <div class="mx-auto sm:px-6 lg:px-8 max-w-7xl justify-center flex flex-row flex-wrap">
    @foreach($infos as $info) 
<div class="flex-grow flex-shrink max-w-xl">

    <x-view.section class="bg-s1">
        <x-slot name="title">
            {{ $info->title}}
            @authRole('admin')
            <x-view.link muted :href="route('info.edit', $info->hashid)" text="Éditer" />
            @endauthRole
        </x-slot>
        <div class="mt-2 quillContent">
            @bindPagesRoute($info->content)
            {{-- @quillContent($info->content) --}}
        </div>

    </x-view.section>
    </div>
    @endforeach
    </div>
</x-app-layout>
