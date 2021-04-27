<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight">
            {{ $page->title }}
        </h1>
    </x-slot>

    @authRole('admin')
    <x-view.links>
        <x-view.link :href="route('page.edit', $page->hashid)" text="Modifier la page" />
        <x-view.link :href="route('info.create')" text="Ajouter une section" />
    </x-view.links>
    @endauthRole

    <div class="mx-auto sm:px-6 lg:px-8 max-w-7xl justify-center flex flex-row flex-wrap">
    @foreach($infos as $info) 
    <div class="flex-grow flex-shrink max-w-xl async-card" data-type="info" data-hashid="{{ $info->hashid }}">
        <x-view.section class="bg-s1">
            <x-slot name="title">
                {{ $info->title}}
                @authRole('admin')
                <x-view.link muted :href="route('info.edit', $info->hashid)" text="Éditer" />
                @endauthRole
            </x-slot>
            {{--<div class="mt-2 quillContentAsync"></div>--}}
            <div class="mt-2 quillContent">
                @bindPagesRoute($info->content)
            </div>
        </x-view.section>
    </div>
    @endforeach
    </div>
    @if($infos->count()==0) 
        <x-view.section class="bg-s1">
        <span>Cette page est vide</span>
        </x-view.section>
    @endif
</x-app-layout>
